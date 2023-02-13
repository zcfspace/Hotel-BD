<nav>
    <ul class="pagination justify-content-center">
        <?php if ($numPag[1] > 1) { ?>
            <li class="page-item">
                <a class="page-link" href="./mainController.php?pagina=<?php echo $numPag[1] - 1 ?>">
                    Anterior
                </a>
            </li>
        <?php } ?>

        <?php for ($x = 1; $x <= $numPag[0]; $x++) { ?>
            <li class="page-item <?php if ($x == $numPag[1]) echo "active" ?>">
                <a class="page-link" href="./mainController.php?pagina=<?php echo $x ?>">
                    <?php echo $x ?></a>
            </li>
        <?php } ?>

        <?php if ($numPag[1] < $numPag[0]) { ?>
            <li class="page-item">
                <a class="page-link" href="./mainController.php?pagina=<?php echo $numPag[1] + 1 ?>">
                    Siguiente
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>