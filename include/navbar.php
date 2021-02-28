<?php
require_once "assets/php/General Functions.php";
require_once "assets/php/User.php";
$user = GetUser();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <a class="navbar-brand" href="index.php"><img src="https://img.icons8.com/officel/30/000000/starred-ticket.png"
                                                  alt="Movie Ticket"/></a>

    <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link breadcrumb-item font-weight-bold black-text text-uppercase" href="index.php">Home</a>
            </li>

            <?php if (LoggedIn() and $user->GetPermission() == "Admin"): ?>
                <!-- Show the A/B Metric Dashboard if an authorised user is logged in -->
                <li class="nav-item">
                    <a class="nav-link breadcrumb-item font-weight-bold black-text text-uppercase" href="metrics.php">A/B
                        Metric Dashboard</a>
                </li>
            <?php endif; ?>
        </ul>
        <ul class="navbar-nav ml-auto navbar-right-top">
            <?php if (LoggedIn()): ?>
                <!-- Dropdown menu for profile, settings, etc for logged in users -->
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenu" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <span class="rounded-circle user-avatar-md text-uppercase"><?php echo $user->GetUsername()[0]; ?></span></a>

                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                         aria-labelledby="navbarDropdownMenu">
                        <a class="dropdown-item" href="profile.php"><i class="fas fa-user mr-2"></i>Account</a>
                        <a class="dropdown-item" href="assets/php/logout.php"><i class="fas fa-power-off mr-2"></i>Logout</a>
                    </div>
                </li>

            <?php else: ?>
                <!-- Login button -->
                <a class="nav-link" href="login.php" id="navbarDropdown">
                    <i class="fas fa-lg fa-key"></i>
                </a>
            <?php endif; ?>
        </ul>
    </div>
</nav>
