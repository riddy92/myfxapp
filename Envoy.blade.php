@servers(['web' => 'deploy@138.68.174.130'])

@setup
    $repo           = 'git@github.com:riddy92/myfxapp.git';
    $base_dir       = '/www/www.justfx.me';
    $release_dir    = $base_dir . '/releases';
    $release        = date('YmdHis');
    $current_dir    = $base_dir . '/current';
    $app_dir        = $base_dir.'/app';
    $php            = 'php7.1-fpm';
    $env            = 'production'
@endsetup

@macro('deploy')
    fetch_repo
    install_packages
    update_symlinks
    migrate
@endmacro

@task('fetch_repo')
    echo "fetching repo"
    [ -d {{ $release_dir }} ] || mkdir {{ $release_dir }};
    cd {{ $release_dir }};
    git clone -b master {{ $repo }} {{ $release }};
@endtask

@task('install_packages')
    echo 'Installing packages'
    cd {{ $release_dir }}/{{ $release }};
    composer install --prefer-dist;
    echo 'Finished installing packages'
@endtask

@task('update_symlinks')
    echo "updating symlinks";

    {{-- project folder --}}
    echo "- linking project folder";
    ln -nfs {{ $release_dir }}/{{ $release }} {{ $app_dir }};
    chgrp -h www-data {{ $app_dir }};

    {{-- environment file --}}
    echo "- linking environment file";
    cd {{ $release_dir }}/{{ $release }};
    ln -nfs ../../.env .env;
    chgrp -h www-data .env;

    {{-- storage folder --}}
    echo "- linking storage folder";

    {{-- Build up the storage folder if it doesn't exist --}}
    [ -d {{ $base_dir }}/storage ] || { cp -a {{ $release_dir }}/{{ $release }}/storage {{ $base_dir }}/storage; chgrp -R www-data {{ $base_dir }}/storage; chmod -R ug+rwx {{ $base_dir }}/storage;}

    {{-- Remove the release storage dir and symlink to the external one --}}
    rm -rf {{ $release_dir }}/{{ $release }}/storage;
    cd {{ $release_dir }}/{{ $release }};

    ln -nfs ../../storage storage;
    chgrp www-data storage;

    {{-- Deploying user must have permission to restart php via sudo without password --}}
    sudo service {{ $php }} reload;
@endtask


@task('migrate')
    echo 'Running migrations';
    cd {{ $release_dir}}/{{ $release }};
    php artisan migrate --force;
@endtask
