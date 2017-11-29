<?php $env = isset($env) ? $env : null; ?>
<?php $php = isset($php) ? $php : null; ?>
<?php $app_dir = isset($app_dir) ? $app_dir : null; ?>
<?php $current_dir = isset($current_dir) ? $current_dir : null; ?>
<?php $release = isset($release) ? $release : null; ?>
<?php $release_dir = isset($release_dir) ? $release_dir : null; ?>
<?php $base_dir = isset($base_dir) ? $base_dir : null; ?>
<?php $repo = isset($repo) ? $repo : null; ?>
<?php $__container->servers(['web' => 'deploy@138.68.174.130']); ?>

<?php
    $repo            'git@github.com:riddy92/myfxapp.git';
    $base_dir       = '/www/www.justfx.me';
    $release_dir    = $base_dir . '/releases';
    $release        = date('YmdHis');
    $current_dir    = $base_dir . '/current';
    $app_dir        = $base_dir.'/app';
    $php            = 'php7.1-fpm';
    $env            = 'production'
?>

<?php $__container->startMacro('deploy'); ?>
    fetch_repo
    install_packages
    update_symlinks
    migrate
<?php $__container->endMacro(); ?>

<?php $__container->startTask('fetch_repo'); ?>
    echo "fetching repo"
    [ -d <?php echo $release_dir; ?> ] || mkdir <?php echo $release_dir; ?>;
    cd <?php echo $release_dir; ?>;
    git clone -b master <?php echo $repo; ?> <?php echo $release; ?>;
<?php $__container->endTask(); ?>

<?php $__container->startTask('install_packages'); ?>
    echo 'Installing packages'
    cd <?php echo $release_dir; ?>/<?php echo $release; ?>;
    composer install --prefer-dist;
    echo 'Finished installing packages'
<?php $__container->endTask(); ?>

<?php $__container->startTask('update_symlinks'); ?>
    echo "updating symlinks";

    <?php /* project folder */ ?>
    echo "- linking project folder";
    ln -nfs <?php echo $release_dir; ?>/<?php echo $release; ?> <?php echo $app_dir; ?>;
    chgrp -h www-data <?php echo $app_dir; ?>;

    <?php /* environment file */ ?>
    echo "- linking environment file";
    cd <?php echo $release_dir; ?>/<?php echo $release; ?>;
    ln -nfs ../../.env .env;
    chgrp -h www-data .env;

    <?php /* storage folder */ ?>
    echo "- linking storage folder";

    <?php /* Build up the storage folder if it doesn't exist */ ?>
    [ -d <?php echo $base_dir; ?>/storage ] || { cp -a <?php echo $release_dir; ?>/<?php echo $release; ?>/storage <?php echo $base_dir; ?>/storage; chgrp -R www-data <?php echo $base_dir; ?>/storage; chmod -R ug+rwx <?php echo $base_dir; ?>/storage;}

    <?php /* Remove the release storage dir and symlink to the external one */ ?>
    rm -rf <?php echo $release_dir; ?>/<?php echo $release; ?>/storage;
    cd <?php echo $release_dir; ?>/<?php echo $release; ?>;

    ln -nfs ../../storage storage;
    chgrp www-data storage;

    <?php /* Deploying user must have permission to restart php via sudo without password */ ?>
    sudo service <?php echo $php; ?> reload;
<?php $__container->endTask(); ?>


<?php $__container->startTask('migrate'); ?>
    echo 'Running migrations';
    cd <?php echo $release_dir; ?>/<?php echo $release; ?>;
    php artisan migrate --force;
<?php $__container->endTask(); ?>
