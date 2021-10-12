<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .rotate {
            -webkit-transition: all 0.5s;
            transition: all 1s;
            transform: rotate(45deg);

        }

        .tes {
            -webkit-transition: all 0.5s;
            transition: all 1s;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.css"
        integrity="sha512-7uSoC3grlnRktCWoO4LjHMjotq8gf9XDFQerPuaph+cqR7JC9XKGdvN+UwZMC14aAaBDItdRj3DcSDs4kMWUgg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.js"
        integrity="sha512-4p9OjnfBk18Aavg91853yEZCA7ywJYcZpFt+YB+p+gLNPFIAlt2zMBGzTxREYh+sHFsttK0CTYephWaY7I3Wbw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <form action="/api/file" enctype="multipart/form-data" method="POST">
        <input type="text" id="firstname" name="firstname" />
        <input type="text" id="lastname" name="lastname" />
        <div class="dropzone" id="myDropzone"></div>
        <button type="submit" id="submit-all"> upload </button>
    </form>

    <script>
        Dropzone.options.myDropzone = {
            url: '/api/file',
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            addRemoveLinks: true,
            maxFilesize: 10000,
            init: function () {
                dzClosure = this;


                document.getElementById("submit-all").addEventListener("click", function (e) {

                    e.preventDefault();
                    e.stopPropagation();
                    dzClosure.processQueue();
                });


                this.on("sendingmultiple", function (data, xhr, formData) {
                    formData.append("firstname", jQuery("#firstname").val());
                    formData.append("lastname", jQuery("#lastname").val());
                });
            }
        }

    </script>
</body>

</html>