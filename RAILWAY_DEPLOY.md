# Railway Deployment Checklist

## Required Environment Variables in Railway Dashboard

Go to your Laravel service → Variables tab and add:

### Application Variables
- `APP_KEY` = base64:cFFOi0ytXrciz7wuYCY0NDqMl7rhpu32wrpAL9vdFOk=
- `APP_ENV` = production
- `APP_DEBUG` = false
- `APP_URL` = https://your-railway-url.up.railway.app

### Database Variables (from MySQL service)
After adding MySQL database, copy these from MySQL service to your app:
- `DB_CONNECTION` = mysql
- `DB_HOST` = (copy MYSQLHOST)
- `DB_PORT` = (copy MYSQLPORT)
- `DB_DATABASE` = (copy MYSQLDATABASE)
- `DB_USERNAME` = (copy MYSQLUSER)
- `DB_PASSWORD` = (copy MYSQLPASSWORD)

### Session Variables
- `SESSION_DRIVER` = database
- `SESSION_LIFETIME` = 120

## Checking Deploy Logs

In Railway dashboard:
1. Click on your Laravel service
2. Click "Deployments" tab
3. Click on the latest deployment
4. View the logs to see error messages

## Common Issues

1. **No APP_KEY** → Add it in Variables
2. **No database connection** → Add MySQL service first
3. **Port not binding** → Should auto-detect from $PORT
4. **Migration errors** → Check database credentials

## Testing Locally

Run: `./start.sh`
Should start server on localhost:8000
