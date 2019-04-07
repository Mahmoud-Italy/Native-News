   <aside class="left-sidebar" data-sidebarbg="skin5">
    <div class="scroll-sidebar">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../layout/index.php" aria-expanded="false">
                        <i class="fa fa-fort-awesome"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../category/category.php" aria-expanded="false">
                        <i class="fa fa-sitemap"></i>
                        <span class="hide-menu">Categories</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../news/list.php" aria-expanded="false">
                        <i class="fa fa-address-book"></i>
                        <span class="hide-menu">News</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../members/list.php" aria-expanded="false">
                        <i class="fa fa-child"></i>
                        <span class="hide-menu">Members </span>
                    </a>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../ads/list.php" aria-expanded="false">
                        <i class="fa fa-rocket"></i>
                        <span class="hide-menu">Ads </span>
                    </a>
                </li>


                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../contact/list.php" aria-expanded="false">
                        <i class="fa fa-envelope"></i>
                        <span class="hide-menu">Messages   
                        <?php
                       $seen = $conn->prepare("SELECT * FROM `contact_us` WHERE seen = 0");
                       $seen->execute();
                       if($seen->rowCount() > 0) {
                         echo '<span class="badge badge-danger">'.$seen->rowCount().'</span>';
                       }
                        ?></span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>