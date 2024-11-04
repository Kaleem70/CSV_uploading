# CSV_uploading
Large CSV file uploading complete project

1. Set Up the Import Routine
Programming Language: Use Core PHP.
Restrictions:
Do not use database triggers.
Do not change the database structure.
Import all the data from the provided CSV file without splitting it.
2. Create a UI Screen for Data Import
Build a user interface (UI) that allows the user to upload the CSV file.
Ensure that the uploaded data is stored in a temporary table in the database.
3. Import the CSV Data
Import the entire CSV data into a single temporary table initially.
The table should hold all 884,950 records.
4. Verify the Imported Data
After importing, check the total count of records and the sum of various amounts  by writing MySQL Queries like:
Due Amount: 12,654,422,921
Paid Amount: 11,461,021,901
Concession: 90,544,480
Scholarship: 471,818,093
Refund: -173,381,473
Verify these sums and record counts against the expected values.
5. Distribute the Data to Relevant Tables
Once the data is verified, distribute it to the remaining database tables as specified. Use the structure provided in the assignment.
 Slide No. 7 provides additional details about how to handle the data distribution across different tables based on the entry mode and voucher type. Here’s a breakdown:

6.  Data Distribution Based on Entry Mode
Entry Mode Explanation:

The slide explains how data should be distributed between different tables (financial_trans and common_fee_collection) based on the entry mode or voucher type.
Entry modes such as DUE, SCHOLARSHIP, CONCESSION, etc., have specific purposes, and they determine where and how data is stored.
Red and Green Categorization:

The red-colored voucher types and amounts should be stored in the financial_trans (parent) and financial_tran_details (child) tables.
The green-colored voucher types and amounts should be stored in the common_fee_collection (parent) and common_fee_collection_headwise (child) tables.
