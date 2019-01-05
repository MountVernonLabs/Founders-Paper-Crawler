# Founders-Paper-Crawler
Parses through the Founders Online website to retrieve all of George Washington's correspondences.

# Usage
- From the terminal, run sh download.sh to retrieve the latest json file from the Library of Congress
- Setup your data tables in MySQL by importing structure.sql
- Run php crawl.php to begin to retrieve all of the letters

# Additional Features
- Run php wordcount.php to go through all of the letters and populate the column for word count