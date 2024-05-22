<nav class="navbar navbar-expand-lg navbar-dark bg-secondary" style="height: 30px; padding: 10px 30px;">
                        <div class="container-fluid">
                                                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button> -->
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav">
                                    <?php
                                    // Check if brandQuery is not null and has rows
                                    if ($brandQuery && mysqli_num_rows($brandQuery) > 0) {
                                        // Fetch each brand
                                        while ($brand = mysqli_fetch_assoc($brandQuery)) {
                                    ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="?category_id=<?php echo $categoryId; ?>&b_id=<?php echo $brand['id']; ?>"><?php echo $brand['B_name']; ?></a>
                                            </li>
                                    <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </nav>