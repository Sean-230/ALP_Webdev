# Railway Deployment Setup

## Required Environment Variables

Set these in your Railway project settings:

### Application
```
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:p7U2CQzD7doCPmlMFmQq61N4j0w6+lx39DSkmtohUms=
APP_URL=https://your-app.railway.app
```

### Database (MySQL)
If using Railway MySQL:
```
DATABASE_URL=${{MySQL.DATABASE_URL}}
```

Or configure individually:
```
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQL_HOST}}
DB_PORT=${{MySQL.MYSQL_PORT}}
DB_DATABASE=${{MySQL.MYSQL_DATABASE}}
DB_USERNAME=${{MySQL.MYSQL_USER}}
DB_PASSWORD=${{MySQL.MYSQL_PASSWORD}}
```

### Session & Cache
```
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

## Steps to Deploy

1. **Add MySQL Service** in Railway (if not added)
   - Click "New" → "Database" → "Add MySQL"

2. **Set Environment Variables**
   - Go to your Laravel service → "Variables"
   - Add all variables listed above
   - Railway will automatically provide MySQL variables

3. **Deploy**
   - Push your code to the connected branch
   - Railway will automatically build and deploy
   - Database migrations will run automatically on startup

4. **Verify Deployment**
   - Check Deploy Logs for any errors
   - Access your app URL
   - If 502 error persists, check the logs for specific errors

## Common Issues

- **502 Bad Gateway**: Check if DATABASE_URL is set and MySQL is running
- **Missing CSS/JS**: Assets are built during Docker build (already configured)
- **Database errors**: Ensure MySQL service is running and connected
