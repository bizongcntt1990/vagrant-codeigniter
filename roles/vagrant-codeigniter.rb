name "vagrant-codeigniter"
description "vagrant-codeigniter roles"
run_list(
  "selinux::disabled",
  "yum::remi",
  "ntp",
  "postfix",
  "memcached",
  "vagrant-codeigniter::db",
  "vagrant-codeigniter::web",
  "vagrant-codeigniter::php"
  )
