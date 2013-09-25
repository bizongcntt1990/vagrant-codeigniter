define :memcached_instance do
  include_recipe "runit"
  include_recipe "memcached"

  opts = params

  runit_service "memcached-#{params[:name]}" do
    run_template_name "memcached"
    default_logger true
    cookbook "memcached"
    options({
      :memory => node['memcached']['memory'],
      :port => node['memcached']['port'],
      :listen => node['memcached']['listen'],
      :maxconn => node['memcached']['maxconn'],
      :user => node['memcached']['user']}.merge(opts)
    )
  end
end
