## Внос/вынос Товарно-материальных ценностей

Для работы сайта имеется заполненная бд tmz.sql в корне


## Конфигурации

Создать файл конфигураций(среды) .env и расположить в корне проекта

APP_NAME="Внос/вынос Товарно-материальных ценностей"
APP_ENV=local
APP_KEY=base64:aHY1rPUF7lW9YpgTEe6PYZg4VIjwtzMTJSnlRmpq0sU=
APP_DEBUG=true
DEBUGBAR_ENABLED=false
APP_URL=http://localhost
APP_LOCALE=ru
APP_FALLBACK_LOCALE=ru
APP_LOCALE_PHP=ru_RU
APP_TIMEZONE=UTC
LOG_CHANNEL=daily

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tmz
DB_USERNAME=tmz_user
DB_PASSWORD=uLYnegj8xNawX3lb

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
QUEUE_CONNECTION=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

# Access
ENABLE_REGISTRATION=true
CHANGE_EMAIL=false
PASSWORD_HISTORY=3
PASSWORD_EXPIRES_DAYS=3000000

# This should be one or the other, or neither
REQUIRES_APPROVAL=false
CONFIRM_EMAIL=true
#//




