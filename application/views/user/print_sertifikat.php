<!DOCTYPE html>
<html>

<head>
    <title>Sales University - Sertifikat</title>
    <style>
        .gfg {
            /* margin: 3%; */
            position: relative;


        }

        .first-txt {
            position: absolute;
            top: 330px;
            left: 400px;

            @font-face {
                font-family: 'Tangerin-Regular';
                src: url('../assets/fontTangerin-Regular.tff');
                font-weight: normal;
                font-style: normal;
            }
        }

        .second-txt {
            position: absolute;
            bottom: 20px;
            left: 10px;
        }
    </style>
</head>

<body>
    <div class="gfg">
        <?php
        $path = base_url("assets/img/sertifikat/sertifikat.png");
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        ?>
        <img src="<?php echo $base64 ?>" style="width:100%;height:100%">
        <h3 class="first-txt">
            GeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeksGeeksforGeeks
        </h3>

        <h3 class="second-txt">
            A computer science portal
        </h3>
    </div>
</body>

</html>