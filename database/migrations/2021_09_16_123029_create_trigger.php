<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER `add_project_trigger` AFTER INSERT ON `projects`
        FOR EACH ROW INSERT INTO logs (project_id,user_id, type, text, created_at)
        VALUES (
            NEW.id,
            NEW.user_id,
            "Project Update",
            CONCAT(
                "Pada ",
                DATE_FORMAT(NOW(),"%d-%M-%Y"),
                ",",
                (SELECT name FROM magang.users WHERE id = NEW.user_id),
                " membuat project ",
                NEW.name,
                ", yang akan berjalan selama ",
                DATEDIFF(NEW.end_date, NEW.start_date),
                " hari. dimulai dari ",
                DATE_FORMAT(NEW.start_date,"%d-%M-%Y"),
                " sampai dengan ",
                DATE_FORMAT(NEW.end_date,"%d-%M-%Y"),
                " ,dengan capaian target peserta sebesar ",
                FORMAT(NEW.target, 0),
                " orang."
            ),
            now()
            )');

        DB::unprepared(
            'CREATE TRIGGER `add_task_trigger` AFTER INSERT ON `tasks` FOR EACH ROW BEGIN
            INSERT INTO
                logs (project_id,user_id, type, text,created_at)
                    VALUES (
                        NEW.project_id,
                        NEW.signer_id,
                        "Task Update",
                        CONCAT((SELECT name FROM magang.users WHERE id = NEW.signer_id),
                               " Menugaskan ",
                               (SELECT name FROM magang.users WHERE id = NEW.user_id),
                               " untuk mengerjakan tugas yaitu ",
                               NEW.name,
                               ", waktu yang diberikan adalah ",
                               DATEDIFF(NEW.deadline, NOW()),
                               " hari, dimulai dari tanggal ",
                               DATE_FORMAT(NOW(),"%d-%M-%Y"),
                               ", sampai dengan ",
                               DATE_FORMAT(NEW.deadline,"%d-%M-%Y"),
                               "."
                              ),
                        now()
                    );
             INSERT INTO
                 task_logs(task_id,title,content,created_at)
                     VALUES(NEW.id,"Inisiasi Task",CONCAT(
                         "Task dibuat pada ",
                         DATE_FORMAT(NOW(),"%d-%M-%Y"),
                         " ,dan ditargetkan selesai pada ",
                         DATE_FORMAT(NEW.deadline,"%d-%M-%Y"),
                         " (",
                         DATEDIFF(NEW.deadline, NOW()),
                         " Hari)"
                     ),
                            now()
                );
            END'
        );

        DB::unprepared(
            'CREATE TRIGGER `update_completed_task` AFTER UPDATE ON `tasks` FOR EACH ROW BEGIN
            IF NEW.status LIKE "completed" THEN
                  INSERT INTO
                      task_logs(task_id,title,content,created_at)
                    VALUES(
                        OLD.id,"Tugas Selesai",
                        CONCAT(
                            "Tugas Telah ditandai selesai pada ",
                            DATE_FORMAT(NOW(),"%d-%M-%Y")
                        ),
                        now()
                    );
            END IF;
            END'
        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `add_project_trigger`');
        DB::unprepared('DROP TRIGGER `add_project_trigger`');
    }
}
