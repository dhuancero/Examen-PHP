<nav class="navPag">
  <ul class="paginacion">
    <?php
    if ($pagina != 1) {
    ?>
      <li class="page-li">
        <a class="page-link" href="index.php?page=<?php echo 1 . '&selectNum=' . $selectNum ?>">
          <span aria-hidden="true">|&laquo;</span>
        </a>
      </li>
      <li class="page-li">
        <a class="page-link" href="index.php?page=<?php echo ($pagina - 1) . '&selectNum=' . $selectNum ?>">
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>
      <?php
    }
    for ($i = 1; $i <= $total_pagina; $i++) {
      // if ($i <= 5) {
      if ($pagina == $i) {
      ?>
        <li class="page-li active"><a class="page-link" href="#"><?php echo $pagina ?></a>
        </li>
      <?php
      } else {
      ?>
        <li class="page-li">
          <a class="page-link" href="index.php?page=<?php echo $i . '&selectNum=' . $selectNum ?>"><?php echo $i  ?></a>
        </li>
      <?php
      }
    }
    // }


    if ($pagina != $total_pagina) {
      ?>
      <li class="page-li">
        <a class="page-link" href="index.php?page=<?php echo ($pagina + 1) . '&selectNum=' . $selectNum ?>">
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
      <li class="page-li">
        <a class="page-link" href="index.php?page=<?php echo $total_pagina  . '&selectNum=' . $selectNum ?>">
          <span aria-hidden="true">&raquo;|</span>
        </a>
      </li>
    <?php
    }
    ?>
  </ul>
</nav>