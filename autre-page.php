<!DOCTYPE html>
<html lang="fr">
<?php 
$titrepage="Autre page";
include("_head.php");
?>
<body>

    <div class="container">
        <h1 class="text-center">MA PAGE réécrite</h1>

        <a href="rewrite.php" class="btn btn-secondary">Retour</a>
        <table class="table table-hover table-bordered">

            <tr>
                <td>
                   $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
                </td>
                <td>
                    <?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];  ?>
                </td>
            </tr>
            <tr>
                <td>
                   basename(__FILE__);
                </td>
                <td>
                    <?php echo basename(__FILE__); ?>
                </td>
            </tr>

            <tr>
                <td>
                    $_GET['var']
                </td>
                <td>
                    <?php echo $_GET['var'] ?>
                </td>
            </tr>

            <tr>
                <td>
                    $_SERVER['REQUEST_URI']
                </td>
                <td>
                    <?php echo $_SERVER['REQUEST_URI'] ?>
                </td>
            </tr>

            <tr>
                <td>
                    $_SERVER['PHP_SELF']
                </td>
                <td>
                    <?php echo $_SERVER['PHP_SELF'] ?>
                </td>
            </tr>
            
            <tr>
                <td>
                    $_SERVER['QUERY_STRING']
                </td>
                <td>
                    <?php echo $_SERVER['QUERY_STRING'] ?>
                </td>
            </tr>
        </table>
    </div>

</body>
</html>