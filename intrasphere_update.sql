INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('lanrooms', 'max_width', '1200');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('lanrooms', 'max_height', '2400');
INSERT INTO {pre}_options (options_mod, options_name, options_value) VALUES ('lanrooms', 'max_size', '409600');

ALTER TABLE {pre}_lanrooms ADD lanrooms_background varchar(80) NOT NULL default '';