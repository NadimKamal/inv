<?php

?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once ("../components/partials/head.php");
?>
 
<body>

    <?php
    include_once ("../components/partials/header.php");
    ?>

    <div class="full">
        <section class="wrapper">

            <div class="container-fluid" style="position: relative;">
                <div class="row">
                    <div class="col-sm-2" id="column1">
                        <?php
                        include_once ("../components/partials/sidenav.php");
                        ?>
                    </div>

                    <div class="col-sm-10 mt-4" id="column2">
                        <?php echo $content ?? ''; ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2 bg-dark"></div>
                <div class="col-10 bg-dark" style="color: white;">
                    <p class="mt-3 ms-4"> &#169; All Copyright Reserve</p>
                </div>
            </div>
        </section>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>

    <script>
        window.onload = function () {
            // Get the heights of both columns
            var col10Height = document.getElementById('column2').offsetHeight;

            // Set the height of col-2 to match col-10
            document.getElementById('column1').style.height = col10Height + 'px';
        }
    </script>
</body>

</html>