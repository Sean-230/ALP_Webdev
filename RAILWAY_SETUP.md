# Railway Deployment Setup

## Required Environment Variables

Set these in your Railway project settings (Laravel service → Variables):

### Application
```
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:p7U2CQzD7doCPmlMFmQq61N4j0w6+lx39DSkmtohUms=
APP_URL=https://festivo.up.railway.app
ASSET_URL=https://festivo.up.railway.app
```

### Database (MySQL)
```
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
```

### Session & Cache
```
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
LOG_LEVEL=error
```

## Critical: ASSET_URL Variable

The `ASSET_URL` variable is **REQUIRED** for Vite assets to load correctly in production. 
Without it, CSS and JS files won't load properly.

Set it to your Railway app URL: `https://festivo.up.railway.app` (or your actual domain)

## Verification Steps

After deployment, check Deploy Logs for these confirmations:

1. ✅ Vite Build Complete - should show `public/build/` directory
2. ✅ CSS files present - should show `public/css/` files  
3. ✅ Images present - should show `public/images/` files
4. ✅ manifest.json shown - Vite manifest with asset mappings

## Troubleshooting

### CSS Not Loading
- Verify `ASSET_URL` is set in Railway variables
- Check Deploy Logs show "=== Checking Build Assets ===" section
- Ensure `public/build/manifest.json` is present in logs

### Images Not Loading  
- Check if images exist in `public/images/` in Deploy Logs
- Verify paths in blade templates use `asset('images/...')`

### Database Connection Issues
- Ensure MySQL service is running
- Verify all DB_* variables reference MySQL service correctly
- Check migrations completed in Deploy Logs
