--       ##########################       ---
--           INSERTS DO SISTEMA           ---
--       ##########################       ---

-- PASSWORD HASH ADMIN = "123456"
INSERT INTO users (id, name, email, password, active, last_access) VALUES (1, 'admin', 'admin@admin.com', '$2y$10$d/jodesdEdVAmbwgrH.GA.O1FaB47mAwCiI1IGmW.q2xcnc5G1foy',1, now());

INSERT INTO pages (path, name, active) VALUES ('admin/menu','Menus',1);
INSERT INTO pages (path, name, active) VALUES ('admin/page','Pages',1);
INSERT INTO pages (path, name, active) VALUES ('admin/user','Users',1);