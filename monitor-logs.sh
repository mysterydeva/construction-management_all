#!/bin/bash

echo "🔍 LOG MONITORING - Real-time Laravel Logs"
echo "========================================"
echo "Watching Laravel log file for new entries..."
echo "Press Ctrl+C to stop monitoring"
echo ""

LOG_FILE="storage/logs/laravel.log"

# Create log file if it doesn't exist
touch $LOG_FILE

# Watch the log file in real-time
tail -f $LOG_FILE | while read line; do
    echo "[$(date '+%H:%M:%S')] $line"
done
