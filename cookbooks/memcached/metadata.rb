name             'memcached'
maintainer       'REALWORLD INC'
maintainer_email 'luan@realworld.jp'
license          'All rights reserved'
description      'Installs/Configures memcached'
long_description IO.read(File.join(File.dirname(__FILE__), 'README.md'))
version          '1.5.1'
#depends          'runit', '~>1.0'
#depends          'yum'

#Adds a description for a recipe - used mainly for aesthetics in the UI.
recipe "memcached", "Installs and configures memcached"

%w{ ubuntu debian redhat fedora centos
scientific amazon smartos suse }.each do |os|
  supports os
end

attribute 'memcached/memory',
    :display_name => 'Memcached Memory',
    :description => 'Memory allocated for memcached instance',
    :default => '1024'

attribute 'memcached/port',
  :display_name => 'Memcached Port',
  :description => 'Port to use for memcached instance',
  :default => '11211'

attribute 'memcached/user',
  :display_name => 'Memcached User',
  :description => 'User to run memcached instance as',
  :default => 'nobody'

attribute 'memcached/listen',
  :display_name => 'Memcached IP Address',
  :description => 'IP address to use for memcached instance',
  :default => '127.0.0.1'

attribute 'memcached/logfilename',
:display_name => 'Memcached logfilename',
:description => 'The filename used to log memcached',
:default => 'memcached.log'