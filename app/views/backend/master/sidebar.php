<div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <div class="user">
                        <div class="avatar-sm float-left mr-2">
                            <img src="./public/assets/img/profile.jpg" alt=".." class="avatar-img rounded-circle">
                        </div>
                        <div class="info">
                            <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                <span>
                                    Duy Cường
                                    <span class="user-level">Administrator</span>
                                    <span class="caret"></span>
                                </span>
                            </a>
                            <div class="clearfix"></div>

                            <div class="collapse in" id="collapseExample">
                                <ul class="nav">
                                    <li>
                                        <a href="#profile">
                                            <span class="link-collapse">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#edit">
                                            <span class="link-collapse">Edit Profile</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-primary">
                        <li class="nav-item active">
                            <a data-toggle="collapse" href="#dashboard" class="collapsed" aria-expanded="false">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section"></h4>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#category">
                                <i class="fas fa-layer-group"></i>
                                <p>Danh mục xe</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="category">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="<?= ADMIN_URL . '/category' ?>">
                                            <span class="sub-item">Danh sách</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= ADMIN_URL . '/category/add' ?>">
                                            <span class="sub-item">Thêm mới</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#location">
                                <i class="fas fa-map-marker-alt"></i>
                                <p>Địa điểm thuê xe</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="location">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="<?= ADMIN_URL . '/location' ?>">
                                            <span class="sub-item">Danh sách</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= ADMIN_URL . '/location/add' ?>">
                                            <span class="sub-item">Thêm mới</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#location">
                                <i class="fas fa-map-marker-alt"></i>
                                <p>Hãng xe</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="location">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="<?= ADMIN_URL . '/maker' ?>">
                                            <span class="sub-item">Danh sách</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?= ADMIN_URL . '/maker/add' ?>">
                                            <span class="sub-item">Thêm mới</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#car">
                                <i class="fas fa-th-list"></i>
                                <p>Xe</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="car">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="">
                                            <span class="sub-item">Danh sách</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <span class="sub-item">Thêm mới</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#users">
                                <i class="fas fa-th-list"></i>
                                <p>Tài khoản</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="users">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="">
                                            <span class="sub-item">Danh sách</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <span class="sub-item">Thêm mới</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#comments">
                                <i class="fas fa-th-list"></i>
                                <p>Bình luận</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="comments">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="">
                                            <span class="sub-item">Danh sách</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <span class="sub-item">Thêm mới</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#orders">
                                <i class="fas fa-th-list"></i>
                                <p>Đơn hàng</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="orders">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="">
                                            <span class="sub-item">Danh sách</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="">
                                            <span class="sub-item">Thêm mới</span>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>