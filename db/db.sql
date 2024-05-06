--       ##########################       ---
--           INSERTS DO SISTEMA           ---
--       ##########################       ---

-- PASSWORD HASH ADMIN = "123456"
INSERT INTO users (id, name, email, password, active, last_access) VALUES (1, 'admin', 'admin@admin.com', '$2y$10$d/jodesdEdVAmbwgrH.GA.O1FaB47mAwCiI1IGmW.q2xcnc5G1foy',1, now());

INSERT INTO permissions (id, name,value,is_default,active) VALUES (1, 'ADMINISTRATOR', 100 , 1, 0);
INSERT INTO permissions (id, name,value,is_default,active) VALUES (2, 'MANAGER', 50 , 1, 0);
INSERT INTO permissions (id, name,value,is_default,active) VALUES (3, 'USER', 10 , 1, 1);

INSERT INTO permissions_users (fk_permission, fk_user) VALUES (1,1);

INSERT INTO menus (id, name, icon, position, active) VALUES (1, 'Administrator','fas fa-cogs', 1, 1);

INSERT INTO pages (path, name, fk_menu, fk_permission, active) VALUES ('admin/menu','Menus', 1, 1, 1);
INSERT INTO pages (path, name, fk_menu, fk_permission, active) VALUES ('admin/page','Pages', 1, 1, 1);
INSERT INTO pages (path, name, fk_menu, fk_permission, active) VALUES ('admin/user','Users', 1, 1, 1);