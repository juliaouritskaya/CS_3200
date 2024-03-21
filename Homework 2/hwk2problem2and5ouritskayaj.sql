-- 2.a Three databases are created by the script: AP, EX, and OM
-- 2.b AP: general_ledger_accounts, invoice_archive, invoice_line_items, invoices, terms, vendor_contacts, vendors
--     EX: active_invoices, color_sample, customers, date_sample, departments, employees, float_sample, null_sample, paid_invoices, projects, string_sample
--     OM: customers, items, order_details, orders
-- 2.c 68 row(s) returned (SELECT * FROM om.order_details)
-- 2.d 114 row(s) returned (SELECT * FROM ap.invoices)
-- 2.e 122 row(s) returned (SELECT * FROM ap.vendors)
-- 2.f Yes, there is a foreign key between the ap.invoices and the ap.vendors table called invoices_fk_vendors
-- 2.g The ap.vendors table has two foreign keys: vendors_fk_accounts and vendors_fk_terms
-- 2.h The primary key for the om.customers table is the customer_id
-- 2.i
SELECT * FROM om.orders;
-- 2.j
SELECT om.items.title, om.items.artist FROM om.items;

-- 5.a Eleven tables are created by the script
-- 5.b Album, Artist, Customer, Employee, Genre, Invoice, InvoiceLine, MediaType, Playlist, PlaylistTrack, Track
-- 5.c 347 row(s) returned (SELECT * FROM Chinook.Album)
-- 5.d The primary key for the Album table is AlbumId 
-- 5.e
SELECT * FROM Chinook.Artist;
-- 5.f 
SELECT Chinook.Employee.FirstName, Chinook.Employee.LastName, Chinook.Employee.Title FROM Chinook.Employee;