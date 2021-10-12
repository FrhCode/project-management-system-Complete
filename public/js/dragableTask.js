const containers = document.querySelectorAll(".draggable-container");
let before, after;
$(".draggable").on("dragstart", function (event) {
    // draggable.classList.add('dragging')
    $(this).addClass("dragging");

    // Variabel buat nampung lokasi sebelum di drag
    before = $(this)
        .parents(".col-lg-4")
        .find(".card-title")
        .text()
        .toLocaleLowerCase();
});

$(".draggable").on("dragend", function (event) {
    $(this).removeClass("dragging");
    let taskId = $(this).data("id")
    // Variabel buat nampung lokasi setelah di drag
    after = $(this)
        .parents(".col-lg-4")
        .find(".card-title")
        .text()
        .toLocaleLowerCase();

    let uploadWithoutFile = function () {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });
        let data = {
            status: after
        };
        // console.log($(this).parents(".col-4"));

        $.ajax({
            type: "PUT",
            url: "task/" + taskId,
            data: data,
            dataType: "JSON",
            success: function (response) {
                // console.log(response);
                toastr.options = { closeButton: true };
                toastr.success("Data berhasil disimpan", "PMS Project");
            },
            // Niatnya kalo gagal mau ngasih feedback, tapi g tau
            fail: function (response) {
                toastr.error("Terjadi kesalahan, Halaman akan dimuat ulang");
            }
        });
    }
    console.log(before);
    console.log(after);
    console.log(before.localeCompare(after));
    // Cek apakah ini udah complete atau blm, kalo udah g boleh di pindahin
    if (!before.localeCompare('completed')) {
        window.location.href = "/error";

        return;
    }
    // Ajax Disini

    // cek pindah posisi?
    else if (before.localeCompare(after) && after.localeCompare('completed')) {
        uploadWithoutFile()
        console.log('disini');

        return
    }
    // Cek apakah tugas dipindahkan atau hanya tukar posisi
    else if (!before.localeCompare(after)) {
        return
    }
    else {
        console.log('ikut');
        $('#upload-file-for-completed-task--modal').modal('show')
        let fileList = [];
        let fistTime = true;
        // console.log(fileList);
        $('input[type=file]').change(function (e) {
            let file = $(this).prop('files')

            $.each(file, function (indexInArray, valueOfElement) {
                if (fistTime) {
                    $('tbody').empty()
                    fistTime = false
                }
                fileList.push(valueOfElement)

                let content =
                    `<tr>
                        <td>${valueOfElement['name']}</td>
                        <td><a href="javascript:;" class="delete-btn--for-file-upload">Hapus</a></td>
                    </tr>`;
                $('tbody').append(content);
            });

            // content =
        })

        $('body').on('click', '.delete-btn--for-file-upload', function (e) {
            e.preventDefault();
            let trTag = $(this).addClass('hapus');

            let filteredElement = $('.delete-btn--for-file-upload').filter(".hapus");
            let index = $('.delete-btn--for-file-upload').index(filteredElement)
            // console.log(index);

            // console.log(fileList[index]);

            console.log(fileList);
            console.log(index);
            if (index > -1) {
                fileList.splice(index, 1);
            }

            // fileList = [2, 9]
            console.log(fileList);

            $(this).parents('tr').empty()
        });

        $('#file-task--completed').submit(function (e) {
            // DO STUFF...
            e.preventDefault();
            var fd = new FormData();

            $.each(fileList, function (indexInArray, valueOfElement) {
                fd.append('file[]', valueOfElement);
            });
            fd.append('status', after);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "task/completed/" + taskId,

                data: fd,
                processData: false,
                contentType: false,
                success: function (data) {
                    location.reload();
                }
            });
        });

        $('#upload-file-for-completed-task--modal').on('hidden.bs.modal', function (event) {
            uploadWithoutFile();
            // console.log('disini');
        })
    }

    // console.log(
    //     $(this)
    //         .parents(".col-3")
    //         .find(".card-title")
    //         .text().toLocaleLowerCase()
    //         // $(this).data('id')
    // );
});

containers.forEach(container => {
    container.addEventListener("dragover", e => {
        e.preventDefault();
        const afterElement = getDragAfterElement(container, e.clientY);
        const draggable = document.querySelector(".dragging");
        if (afterElement == null) {
            container.appendChild(draggable);
        } else {
            container.insertBefore(draggable, afterElement);
        }
        // console.log(draggable)
    });
});

function getDragAfterElement(container, y) {
    const draggableElements = [
        ...container.querySelectorAll(".draggable:not(.dragging)")
    ];

    return draggableElements.reduce(
        (closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;
            if (offset < 0 && offset > closest.offset) {
                return {
                    offset: offset,
                    element: child
                };
            } else {
                return closest;
            }
        },
        {
            offset: Number.NEGATIVE_INFINITY
        }
    ).element;
}
