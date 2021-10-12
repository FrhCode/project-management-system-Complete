<?php

use App\Division;
use App\File;
use App\Occupation;
use App\Project;
use App\Task;
use App\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Symfony\Component\Console\Color;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        // $this->call(UsersTableSeeder::class);

        Occupation::insert([
            [
                'name' => 'Admin',
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],
            [
                'name' => 'Team Leader',
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],

            [
                'name' => 'Team Member',
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],
        ]);

        Division::insert([
            [
                'title' => 'Admin',
                'Name'  => 'Admin',
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],

            [
                'title' => 'LD',
                'Name'  => 'Learning Designer',
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],

            [
                'title' => 'LSP',
                'Name'  => 'Lembaga sertifikasi profesi',
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],

            [
                'title' => 'IT',
                'Name'  => 'Software Devalopher',
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],
        ]);

        User::insert([
            [
                'division_id'      => 1,
                'occupation_id'    => 1,
                'name'          => 'Fitra',
                'usrName'         => 'fitri1016',
                'img'           => 'user3-128x128.jpg',
                'password'      => bcrypt('asd'),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],

            [
                'division_id'      => 2,
                'occupation_id'    => 2,
                'name'          => 'Jimmy Kimmel',
                'usrName'         => 'jimmy99',
                'img'           => 'user6-128x128.jpg',
                'password'      => bcrypt('asd'),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],

            [
                'division_id'      => 2,
                'occupation_id'    => 3,
                'name'          => 'Mohammad Farhan',
                'usrName'         => 'farhan20',
                'img'           => 'user8-128x128.jpg',
                'password'      => bcrypt('asd'),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],

            [
                'division_id'      => 3,
                'occupation_id'    => 2,
                'name'          => 'M.Firman A',
                'usrName'         => 'firman09',
                'img'           => 'avatar.png',
                'password'      => bcrypt('asd'),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],

            [
                'division_id'      => 3,
                'occupation_id'    => 3,
                'name'          => 'Rani Novita',
                'usrName'         => 'ranian',
                'img'           => 'user4-128x128.jpg',
                'password'      => bcrypt('asd'),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],


        ]);
        // factory(Project::class, 1000)->create();
        Project::insert([
            [
                'user_id'       => User::inRandomOrder()->first()->id,
                'name'          => 'BLDP 1 SPO',
                'color'         => '#fcba03',
                'target'        => rand(100000, 20000),
                'tercapai'      => rand(1001, 10000),
                'description'   => 'BLDP adalah program pengembangan leadership yang berkelanjutan dan komprehensif yang memberikan penekanan pada penguatan karakter, wawasan kebangsaan, wawasan global, wawasan bisnis / perbankan, serta wawasan teknologi',
                'start_date'    => Carbon::now()->addDays(rand(1, 5))->format('Y-m-d'),
                'end_date'      => Carbon::now()->addMonths(rand(10, 17))->format('Y-m-d'),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],
            [
                'user_id'       => User::inRandomOrder()->first()->id,
                'name'          => 'Sertifikasi Peserta BSDP',
                'color'         => '#03e3fc',
                'target'        => rand(100000, 20000),
                'tercapai'      => rand(1001, 10000),
                'description'   => 'Sertifikasi adalah sebuah penetapan yang diberikan oleh organisasi atau asosiasi profesi terhadap seseorang bahwa orang tersebut telah memenuhi standar kompetensi tertentu. ',
                'start_date'    => Carbon::now()->addDays(rand(1, 5))->format('Y-m-d'),
                'end_date'      => Carbon::now()->addMonths(rand(5, 30))->format('Y-m-d'),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],
        ]);

        $color = ['#053742', '#39A2DB', '#A2DBFA'];
        // Task::insert([
        //     [
        //         'project_id'    => 1,
        //         'user_id'       => 3,
        //         // 'division_id'   => 2,
        //         'name'          => 'Buat PPT',
        //         'detail'        => "Buat PPT yang bener jangan asal tempel ya......",
        //         // Complete date diambil dari nilai random antara start date dan end date dari task itu sendiri
        //         // 'complete_date' => date('Y-m-d H:i:s', rand(DateTime::createFromFormat('Y-m-d H:i:s', Project::find(1)->start_date)->getTimestamp(), DateTime::createFromFormat('Y-m-d H:i:s', Project::find(1)->end_date)->getTimestamp())),
        //         'status'        => 'todo',
        //         'created_at'    => Carbon::now()->format('Y-m-d'),
        //         'updated_at'    => Carbon::now()->format('Y-m-d'),
        //     ],

        //     [
        //         'project_id'    => 1,
        //         'user_id'       => 2,
        //         // 'division_id'   => 3,
        //         'name'          => 'Buat LJ',
        //         'status'        => 'todo',
        //         'detail'        => "Buat LJ yang teliti jangan asal dikumpulin1",
        //         'created_at'    => Carbon::now()->format('Y-m-d'),
        //         'updated_at'    => Carbon::now()->format('Y-m-d'),
        //     ],

        //     [
        //         'project_id'    => 3,
        //         'user_id'       => 5,
        //         // 'division_id'   => 4,
        //         'name'          => 'Verifikasi Nama',
        //         'status'        => 'todo',>
        //         'detail'        => "Periksa data nya bener2, kalo ampe salah bakal panjang",
        //         'created_at'    => Carbon::now()->format('Y-m-d'),
        //         'updated_at'    => Carbon::now()->format('Y-m-d'),
        //     ],
        //     [
        //         'project_id'    => 2,
        //         'user_id'       => 5,
        //         // 'division_id'   => 4,
        //         'status'        => 'todo',
        //         'name'          => 'Buatin LJ',
        //         'detail'        => "LJ tentang IT,buat aja pake template terlampir",
        //         'created_at'    => Carbon::now()->format('Y-m-d'),
        //         'updated_at'    => Carbon::now()->format('Y-m-d'),
        //     ],
        // ]);

        // $projects = Project::all();
        // foreach (User::where('division_id', '!=', 1)->get() as $key => $user) {
        //     for ($i = 0; $i < rand(3, 10); $i++) {
        //         $project_id = $projects->random(1)->first()->id;
        //         $user->task()->create([
        //             'signer_id'        => User::where('division_id', $user->division_id)->where('occupation_id', 2)->first()->id,
        //             'project_id'    => $project_id,
        //             'user_id'       => 5,
        //             'status'        => $faker->randomElement($array = array('todo', 'on progress', 'completed')),
        //             'name'          => $faker->words(6, true),
        //             'detail'        => $faker->text(200),
        //             'deadline'      => Helper::rand_date(project::find($project_id)->start_date, project::find($project_id)->end_date),
        //             'created_at'    => Carbon::now()->format('Y-m-d'),
        //             'updated_at'    => Carbon::now()->format('Y-m-d'),
        //         ]);
        //     }
        // }

        Task::insert([
            [
                'signer_id'     => User::where('division_id', '!=', 1)->where('occupation_id', 2)->inRandomOrder()->first()->id,
                'project_id'    => 1,
                'user_id'       => User::where('division_id', '!=', 1)->inRandomOrder()->first()->id,
                'status'        => $faker->randomElement($array = array('todo', 'on progress', 'completed')),
                'name'          => 'Membuat Kurikulum',
                'detail'        => 'Harus dibuat dengan baik, sesuai dengan harapan yang bisa didapatkan, dan setiap target kompetensi juga ditulis dengan rapih, target per triwulan tertulis dengan jelas',
                'deadline'      => Helper::rand_date(project::find(1)->start_date, project::find(1)->end_date),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],
            [
                'signer_id'     => User::where('division_id', '!=', 1)->where('occupation_id', 2)->inRandomOrder()->first()->id,
                'project_id'    => 1,
                'user_id'       => User::where('division_id', '!=', 1)->inRandomOrder()->first()->id,
                'status'        => $faker->randomElement($array = array('todo', 'on progress', 'completed')),
                'name'          => 'Membuat Learning Journey',
                'detail'        => 'Dibuat yang rapih jangan asal jadi, pastikan setiap tulisan terbaca dengan jelas, jika ada kesulitan jangan ragu bertanya',
                'deadline'      => Helper::rand_date(project::find(1)->start_date, project::find(1)->end_date),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],
            [
                'signer_id'     => User::where('division_id', '!=', 1)->where('occupation_id', 2)->inRandomOrder()->first()->id,
                'project_id'    => 1,
                'user_id'       => User::where('division_id', '!=', 1)->inRandomOrder()->first()->id,
                'status'        => $faker->randomElement($array = array('todo', 'on progress', 'completed')),
                'name'          => 'Membuat Learning Roadmap ',
                'detail'        => 'Dibuat yang rapih jangan asal jadi, pastikan setiap tulisan terbaca dengan jelas, jika ada kesulitan jangan ragu bertanya',
                'deadline'      => Helper::rand_date(project::find(1)->start_date, project::find(1)->end_date),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],
            [
                'signer_id'     => User::where('division_id', '!=', 1)->where('occupation_id', 2)->inRandomOrder()->first()->id,
                'project_id'    => 1,
                'user_id'       => User::where('division_id', '!=', 1)->inRandomOrder()->first()->id,
                'status'        => $faker->randomElement($array = array('todo', 'on progress', 'completed')),
                'name'          => 'Membuat Materi ',
                'detail'        => 'Pastikan meteri yang dibuat relavan dengan masa sekarang, jangan asal ambil dari bekas tahun2 sebelumnya',
                'deadline'      => Helper::rand_date(project::find(1)->start_date, project::find(1)->end_date),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],

            [
                'signer_id'     => User::where('division_id', '!=', 1)->where('occupation_id', 2)->inRandomOrder()->first()->id,
                'project_id'    => 2,
                'user_id'       => User::where('division_id', '!=', 1)->inRandomOrder()->first()->id,
                'status'        => $faker->randomElement($array = array('todo', 'on progress', 'completed')),
                'name'          => 'Membuat Kurikulum',
                'detail'        => 'Harus dibuat dengan baik, sesuai dengan harapan yang bisa didapatkan, dan setiap target kompetensi juga ditulis dengan rapih, target per triwulan tertulis dengan jelas',
                'deadline'      => Helper::rand_date(project::find(2)->start_date, project::find(2)->end_date),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],
            [
                'signer_id'     => User::where('division_id', '!=', 1)->where('occupation_id', 2)->inRandomOrder()->first()->id,
                'project_id'    => 2,
                'user_id'       => User::where('division_id', '!=', 1)->inRandomOrder()->first()->id,
                'status'        => $faker->randomElement($array = array('todo', 'on progress', 'completed')),
                'name'          => 'Membuat Learning Journey',
                'detail'        => 'Dibuat yang rapih jangan asal jadi, pastikan setiap tulisan terbaca dengan jelas, jika ada kesulitan jangan ragu bertanya',
                'deadline'      => Helper::rand_date(project::find(2)->start_date, project::find(2)->end_date),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],
            [
                'signer_id'     => User::where('division_id', '!=', 1)->where('occupation_id', 2)->inRandomOrder()->first()->id,
                'project_id'    => 2,
                'user_id'       => User::where('division_id', '!=', 1)->inRandomOrder()->first()->id,
                'status'        => $faker->randomElement($array = array('todo', 'on progress', 'completed')),
                'name'          => 'Membuat Learning Roadmap ',
                'detail'        => 'Dibuat yang rapih jangan asal jadi, pastikan setiap tulisan terbaca dengan jelas, jika ada kesulitan jangan ragu bertanya',
                'deadline'      => Helper::rand_date(project::find(2)->start_date, project::find(2)->end_date),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ],
            [
                'signer_id'     => User::where('division_id', '!=', 1)->where('occupation_id', 2)->inRandomOrder()->first()->id,
                'project_id'    => 2,
                'user_id'       => User::where('division_id', '!=', 1)->inRandomOrder()->first()->id,
                'status'        => $faker->randomElement($array = array('todo', 'on progress', 'completed')),
                'name'          => 'Membuat Materi ',
                'detail'        => 'Pastikan meteri yang dibuat relavan dengan masa sekarang, jangan asal ambil dari bekas tahun2 sebelumnya',
                'deadline'      => Helper::rand_date(project::find(2)->start_date, project::find(2)->end_date),
                'created_at'    => Carbon::now()->format('Y-m-d'),
                'updated_at'    => Carbon::now()->format('Y-m-d'),
            ]
        ]);

        File::insert([
            [
                'name' => 'text.txt',
                'task_id' => 1,
                'title' => 'text.txt',
                'size' => '87561',
                'extension' => 'txt',
            ],
            [
                'name' => 'text.txt',
                'task_id' => 1,
                'title' => 'text.txt',
                'size' => '87561',
                'extension' => 'txt',
            ],
            [
                'name' => 'text.txt',
                'task_id' => 1,
                'title' => 'text.txt',
                'size' => '87561',
                'extension' => 'txt',
            ],
            [
                'name' => 'text.txt',
                'task_id' => 2,
                'title' => 'text.txt',
                'size' => '87561',
                'extension' => 'txt',
            ],
            [
                'name' => 'text.txt',
                'task_id' => 4,
                'title' => 'text.txt',
                'size' => '87561',
                'extension' => 'txt',
            ],
            [
                'name' => 'text.txt',
                'task_id' => 6,
                'title' => 'text.txt',
                'size' => '87561',
                'extension' => 'txt',
            ],
            [
                'name' => 'text.txt',
                'task_id' => 5,
                'title' => 'text.txt',
                'size' => '87561',
                'extension' => 'txt',
            ]
        ]);
    }
}
