  <div id="get_category"> </div>
                        <div class="nav nav-pills flex-column">
                            <h4 class="nav-item">Categories</h4>
                            <?php foreach ($category as $cat_id => $name) : ?>
                                <li class="nav-item">
                                    <a href="?category_id=<?php echo $cat_id; ?>" class="nav-link <?php echo (isset($_GET['category_id']) && $cat_id == $_GET['category_id']) ? 'active' : ''; ?>">
                                        <?php echo $name; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </div>
                </div>