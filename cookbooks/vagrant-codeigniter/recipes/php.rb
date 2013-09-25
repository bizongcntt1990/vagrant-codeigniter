include_recipe "php53"

include_recipe "phpmyadmin"

package "php-pecl-memcache" do
    action :install
end