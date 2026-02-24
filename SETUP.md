# 🚀 QUICK SETUP GUIDE

## Server Status: ✅ RUNNING
The Laravel development server is running on **http://localhost:8000**

## 🌐 Access URLs

### Main Login Page
```
http://localhost:8000/login
```

### Business Subdomains (add to hosts file first!)
```
http://construction.localhost:8000  - Construction Business
http://upvc.localhost:8000         - UPVC Business  
http://interior.localhost:8000      - Interior Business
```

## 📋 Setup Steps

### 1. Add Subdomains to Hosts File
Edit your hosts file:
- **Linux/Mac**: `/etc/hosts`
- **Windows**: `C:\Windows\System32\drivers\etc\hosts`

Add these lines:
```
127.0.0.1 construction.localhost
127.0.0.1 upvc.localhost
127.0.0.1 interior.localhost
```

### 2. Access the Demo
1. Open your browser
2. Go to `http://localhost:8000/login` to see the login page
3. Or add hosts entries and access subdomains directly

## 🔧 Demo Credentials
```
Construction: admin@construction.local / password
UPVC: admin@upvc.local / password
Interior: admin@interior.local / password
```

## 📊 What's Working
- ✅ Laravel server running
- ✅ Routes configured
- ✅ Views created
- ✅ Demo data ready
- ✅ Bootstrap UI
- ✅ Chart.js dashboards

## 🎯 Features to Test
- Login page design
- Dashboard layouts (different per business)
- Project listings
- Invoice creation with GST
- Responsive design

## 🐛 Troubleshooting
If subdomains don't work:
1. Make sure hosts file is saved
2. Clear browser cache
3. Try `http://localhost:8000` first
4. Use IP addresses instead of localhost if needed
