#
# Cookbook Name:: memcached
# Recipe:: default
#
# Copyright 2013, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#
# include epel on redhat/centos 5 and below in order to get the memcached packages

package "memcached" do
  action :upgrade
end

package "libevent-devel" do
  package_name "libevent-devel"
  action :upgrade
end

service "memcached" do
  action :nothing
  supports :status => true, :start => true, :stop => true, :restart => true
end

template "/etc/memcached.conf" do
    source "memcached.conf.erb"
    owner "root"
    group "root"
    mode 00644
    variables(
        :listen => node['memcached']['listen'],
        :user => node['memcached']['user'],
        :port => node['memcached']['port'],
        :maxconn => node['memcached']['maxconn'],
        :memory => node['memcached']['memory'],
        :max_object_size => node['memcached']['max_object_size']
    )
    notifies :restart, "service[memcached]"
end
