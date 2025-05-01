-- Insert demo users (password_hash will be filled later manually)
INSERT INTO Users (first_name, last_name, email, phone_number, address, password_hash, role)
VALUES 
('Admin', 'Elite', 'admin@elite.com', '1234567890', '123 Admin St, Bolivia', '$2y$12$VRTmydZW/kus63FJoThw7Oy0.q8EFgfolM.LfKJv.KlC2u6LeVQdK', 'admin'),
('Alex', 'Ramirez', 'alex@elite.com', '0987654321', '456 Elm St, Bolivia', '$2y$12$W5fRCO6n98ONHd9anODdWexTY8j4QkNmdtaAL/Oo9XGvy5lmXinFe', 'customer'),
('Jessica', 'Lopez', 'jessica@elite.com', '1122334455', '789 Oak St, Bolivia', '$2y$12$dhwyB9rNwnZULaTl6g78wu2JKrdZRS5m4jHLEzu1eh8hkBX5yJSRy', 'customer');

-- Insert demo product
INSERT INTO Products (name, description, price, stock)
VALUES ('Nike Air Zoom Mercurial Superfly 10 Elite AG-Pro Football Boots', 'Nike Air Zoom Mercurial Superfly 10 Elite AG-Pro football boots. Threaded boots, with ankle support, to be used on artificial grass pitches. Premium boots for fast players in Black-Black-Deep Jungle colourway.

The swoosh brand returns to black in this Black Pack. Discretion and sobriety in all its silos in one of the most desired collections by users every year. Go unnoticed on the pitch until the ball reaches your feet!

Includes gymsack', 219.99, 15);


-- Insert related images for product_id = 1
INSERT INTO Product_Images (product_id, image_url)
VALUES
(1, 'assets/p_images/bota-nike-air-zoom-mercurial-superfly-10-elite-ag-pro-black-black-deep-jungle-0.webp'),
(1, 'assets/p_images/bota-nike-air-zoom-mercurial-superfly-10-elite-ag-pro-black-black-deep-jungle-1.webp'),
(1, 'assets/p_images/bota-nike-air-zoom-mercurial-superfly-10-elite-ag-pro-black-black-deep-jungle-2.webp'),
(1, 'assets/p_images/bota-nike-air-zoom-mercurial-superfly-10-elite-ag-pro-black-black-deep-jungle-3.webp'),
(1, 'assets/p_images/bota-nike-air-zoom-mercurial-superfly-10-elite-ag-pro-black-black-deep-jungle-4.webp'),
(1, 'assets/p_images/bota-nike-air-zoom-mercurial-superfly-10-elite-ag-pro-black-black-deep-jungle-5.webp'),
(1, 'assets/p_images/bota-nike-air-zoom-mercurial-superfly-10-elite-ag-pro-black-black-deep-jungle-6.webp');

-- Insert a demo order for user_id = 2 (Alex)
INSERT INTO Orders (user_id, total_amount, shipping_address, status)
VALUES (2, 219.99, '456 Elm St, Bolivia', 'pending');

-- Insert a matching order item for that order (assume order_id = 1)
INSERT INTO Order_Items (order_id, product_id, quantity, size, price_at_purchase)
VALUES (1, 1, 1, '10', 219.99);

-- Insert product 2
INSERT INTO Products (name, description, price, stock)
VALUES ('adidas Predator Elite FT FG +Teamgeist Football Boots', 'adidas Predator Elite FT FG +Teamgeist football boot for adults. Synthetic boots with laces for use on natural grass pitches. High-end boots in White-Core Black-Gold Met colourway.
 
In 2006 adidas presented one of the most iconic footballs in its history for the German World Cup: the + Teamgeist. Almost twenty years later, the German brand has been inspired by it to create a unique limited edition Predator. A perfect design within reach of very few.', 279.99, 12);
-- Insert images for product_id = 2
INSERT INTO Product_Images (product_id, image_url) VALUES (2, 'assets/p_images/bota-adidas-predator-elite-ft-fg-teamgeist-white-core-black-gold-met-0.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (2, 'assets/p_images/bota-adidas-predator-elite-ft-fg-teamgeist-white-core-black-gold-met-1.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (2, 'assets/p_images/bota-adidas-predator-elite-ft-fg-teamgeist-white-core-black-gold-met-2.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (2, 'assets/p_images/bota-adidas-predator-elite-ft-fg-teamgeist-white-core-black-gold-met-3.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (2, 'assets/p_images/bota-adidas-predator-elite-ft-fg-teamgeist-white-core-black-gold-met-4.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (2, 'assets/p_images/bota-adidas-predator-elite-ft-fg-teamgeist-white-core-black-gold-met-5.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (2, 'assets/p_images/bota-adidas-predator-elite-ft-fg-teamgeist-white-core-black-gold-met-6.webp');

-- Insert product 3
INSERT INTO Products (name, description, price, stock)
VALUES ('Nike Air Zoom Mercurial Vapor 16 Academy AG Football Boots', 'Nike Zoom Mercurial Vapor 16 Academy AG football boots for adults. Threaded boots, to be used on artificial grass pitches. Mid-range boots in Ember Glow-Aurora Green colourway.

2025 begins and Nike is ready to keep surprising everyone. The first main pack of the year presents a groundbreaking design with a striking colour combination in all its silos. Red and turquoise are a perfect choice to stand out from the crowd until the ball hits your feet!', 73.99, 13);
-- Insert images for product_id = 3
INSERT INTO Product_Images (product_id, image_url) VALUES (3, 'assets/p_images/bota-nike-air-zoom-mercurial-vapor-16-akademie-ag-rosa-0.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (3, 'assets/p_images/bota-nike-air-zoom-mercurial-vapor-16-akademie-ag-rosa-1.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (3, 'assets/p_images/bota-nike-air-zoom-mercurial-vapor-16-akademie-ag-rosa-2.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (3, 'assets/p_images/bota-nike-air-zoom-mercurial-vapor-16-akademie-ag-rosa-3.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (3, 'assets/p_images/bota-nike-air-zoom-mercurial-vapor-16-akademie-ag-rosa-4.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (3, 'assets/p_images/bota-nike-air-zoom-mercurial-vapor-16-akademie-ag-rosa-5.webp');

-- Insert product 4
INSERT INTO Products (name, description, price, stock)
VALUES ('Under Armour Magnetico Select 4 FG Football Boots', 'Under Amour Magnetic Select 4 FG football boot. Base range boots made of synthetic leather for natural grass pitches. 

The American brand presents its second main pack of the year. A new colourway for its two main silos: Magnetic and Shadow. Both are a perfect choice for this end of season thanks to their great fit and adaptability. Great players like Rüdiger or Fermín bet on them to achieve their goals on the pitch', 79.99, 14);
-- Insert images for product_id = 4
INSERT INTO Product_Images (product_id, image_url) VALUES (4, 'assets/p_images/bota-under-armour-magnetico-select-4-fg-verde-0.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (4, 'assets/p_images/bota-under-armour-magnetico-select-4-fg-verde-1.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (4, 'assets/p_images/bota-under-armour-magnetico-select-4-fg-verde-2.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (4, 'assets/p_images/bota-under-armour-magnetico-select-4-fg-verde-3.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (4, 'assets/p_images/bota-under-armour-magnetico-select-4-fg-verde-4.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (4, 'assets/p_images/bota-under-armour-magnetico-select-4-fg-verde-5.webp');

-- Insert product 5
INSERT INTO Products (name, description, price, stock)
VALUES ('adidas Predator League FT FG/MG Jude Bellingham Football Boots', 'adidas Predator League FT FG Jude Bellingham football boot. Synthetic boots with tongue for use on natural grass pitches. Mid-range boots in Silver Met-Legacy Burgundy-Maroon colour.
adidas presents a new special edition for one of its main ambassadors: Real Madrid star Jude Bellingham. The Predator Chrome Dream design is inspired by the English midfielders obsession with the colour silver, synonymous with the elegance he displays on the pitch', 109.99, 15);
-- Insert images for product_id = 5
INSERT INTO Product_Images (product_id, image_url) VALUES (5, 'assets/p_images/bota-adidas-predator-league-ft-fgmg-jb-silver-met-legacy-burgundy-maroon-0.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (5, 'assets/p_images/bota-adidas-predator-league-ft-fgmg-jb-silver-met-legacy-burgundy-maroon-1.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (5, 'assets/p_images/bota-adidas-predator-league-ft-fgmg-jb-silver-met-legacy-burgundy-maroon-2.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (5, 'assets/p_images/bota-adidas-predator-league-ft-fgmg-jb-silver-met-legacy-burgundy-maroon-3.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (5, 'assets/p_images/bota-adidas-predator-league-ft-fgmg-jb-silver-met-legacy-burgundy-maroon-4.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (5, 'assets/p_images/bota-adidas-predator-league-ft-fgmg-jb-silver-met-legacy-burgundy-maroon-5.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (5, 'assets/p_images/bota-adidas-predator-league-ft-fgmg-jb-silver-met-legacy-burgundy-maroon-6.webp');

-- Insert product 6
INSERT INTO Products (name, description, price, stock)
VALUES ('Mizuno Morelia II Pro FG Football Boots', 'Mizuno Morelia II Pro FG football boots. Mid-range boots to be used on natural grass fields in Galaxy Silver-Gold-Gold colouway.

Lightness and flexibility are the main features of this new release from Mizuno: the Platinum Silver Pack. A perfect leather boot for those who love the classics.', 119.99, 16);
-- Insert images for product_id = 6
INSERT INTO Product_Images (product_id, image_url) VALUES (6, 'assets/p_images/bota-mizuno-morelia-ii-pro-fg-plata-0.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (6, 'assets/p_images/bota-mizuno-morelia-ii-pro-fg-plata-1.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (6, 'assets/p_images/bota-mizuno-morelia-ii-pro-fg-plata-2.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (6, 'assets/p_images/bota-mizuno-morelia-ii-pro-fg-plata-3.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (6, 'assets/p_images/bota-mizuno-morelia-ii-pro-fg-plata-4.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (6, 'assets/p_images/bota-mizuno-morelia-ii-pro-fg-plata-5.webp');

-- Insert product 7
INSERT INTO Products (name, description, price, stock)
VALUES ('adidas Copa Pure III Club Turf Football Boots', 'Copa Pure III Club Turf boot from adidas in Halo Blue-Blue Fusion-Lucid Lemon colour. Basic range boot for carpet or second generation artificial turf pitches.

adidas introduces its second main pack of the year: the Celestial Victory Pack. The Copa silo takes a more subdued approach, with silver tones accented by bright yellow details. The F50, on the other hand, adopts a more vibrant and energetic combination, offering what looks like an alternative version of the Mystic Victory design. The Predator, true to its disruptive heritage, is the most striking of the trio, with a vibrant combination of white, pink and lemon reflecting the boots aggressive innovation. Either one is a perfect choice for this end of season!', 54.99, 17);
-- Insert images for product_id = 7
INSERT INTO Product_Images (product_id, image_url) VALUES (7, 'assets/p_images/bota-adidas-copa-pure-iii-club-turf-halo-blue-blue-fusion-lucid-lemon-0.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (7, 'assets/p_images/bota-adidas-copa-pure-iii-club-turf-halo-blue-blue-fusion-lucid-lemon-1.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (7, 'assets/p_images/bota-adidas-copa-pure-iii-club-turf-halo-blue-blue-fusion-lucid-lemon-2.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (7, 'assets/p_images/bota-adidas-copa-pure-iii-club-turf-halo-blue-blue-fusion-lucid-lemon-3.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (7, 'assets/p_images/bota-adidas-copa-pure-iii-club-turf-halo-blue-blue-fusion-lucid-lemon-4.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (7, 'assets/p_images/bota-adidas-copa-pure-iii-club-turf-halo-blue-blue-fusion-lucid-lemon-5.webp');

-- Insert product 8
INSERT INTO Products (name, description, price, stock)
VALUES ('Puma King Ultimate X Porsche FG/AG Football Boots', 'Puma King Ultimate FG/AG football boots in Olive Drab-Black-Gold colourway. Boots to play on natural and artificial grass pitches.

Puma presents a new limited edition for this April. A collaboration between the most iconic silo of the feline brand and the prestigious car brand ‘Porsche’. A special design for a very special launch. Dont miss the opportunity and get one of them!', 249.99, 18);
-- Insert images for product_id = 8
INSERT INTO Product_Images (product_id, image_url) VALUES (8, 'assets/p_images/bota-puma-king-ultimate-x-porsche-fgag-olive-drab-black-gold-0.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (8, 'assets/p_images/bota-puma-king-ultimate-x-porsche-fgag-olive-drab-black-gold-1.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (8, 'assets/p_images/bota-puma-king-ultimate-x-porsche-fgag-olive-drab-black-gold-2.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (8, 'assets/p_images/bota-puma-king-ultimate-x-porsche-fgag-olive-drab-black-gold-3.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (8, 'assets/p_images/bota-puma-king-ultimate-x-porsche-fgag-olive-drab-black-gold-4.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (8, 'assets/p_images/bota-puma-king-ultimate-x-porsche-fgag-olive-drab-black-gold-5.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (8, 'assets/p_images/bota-puma-king-ultimate-x-porsche-fgag-olive-drab-black-gold-6.webp');

-- Insert product 9
INSERT INTO Products (name, description, price, stock)
VALUES ('adidas Predator Elite FT SG Football Boots', 'adidas Predator Elite FT SG football boot for adults. Synthetic boots with laces for use on wet natural grass pitches. High-end boots in White-Lucid Pink-Lucid Lemon colourway.

adidas introduces its second main pack of the year: the Celestial Victory Pack. The Copa silo takes a more understated approach, with silver tones accented by striking yellow details. The F50, on the other hand, adopts a more vibrant and energetic combination, offering what looks like an alternative version of the Mystic Victory design. The Predator, true to its disruptive heritage, is the most striking of the trio, with a vibrant combination of white, pink and lemon reflecting the boots aggressive innovation. Either is a perfect choice for this end of season!', 279.99, 19);
-- Insert images for product_id = 9
INSERT INTO Product_Images (product_id, image_url) VALUES (9, 'assets/p_images/bota-adidas-predator-elite-ft-sg-white-lucid-pink-lucid-lemon-0.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (9, 'assets/p_images/bota-adidas-predator-elite-ft-sg-white-lucid-pink-lucid-lemon-1.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (9, 'assets/p_images/bota-adidas-predator-elite-ft-sg-white-lucid-pink-lucid-lemon-2.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (9, 'assets/p_images/bota-adidas-predator-elite-ft-sg-white-lucid-pink-lucid-lemon-3.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (9, 'assets/p_images/bota-adidas-predator-elite-ft-sg-white-lucid-pink-lucid-lemon-4.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (9, 'assets/p_images/bota-adidas-predator-elite-ft-sg-white-lucid-pink-lucid-lemon-5.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (9, 'assets/p_images/bota-adidas-predator-elite-ft-sg-white-lucid-pink-lucid-lemon-6.webp');

-- Insert product 10
INSERT INTO Products (name, description, price, stock)
VALUES ('adidas Predator Elite FT FG Jude Bellingham Football Boots', 'Predator Elite FT FG JB football boot in Silver Met-Legacy Burgundy-Maroon colour. Boot for use on dry natural grass pitches. High-end and special edition boot.

adidas presents a new special edition for one of its main ambassadors: Real Madrid star Jude Bellingham. The Predator Chrome Dream design is inspired by the English midfielders obsession with the colour silver, synonymous with the elegance he displays on the pitch. A perfect capsule for any lover of Englands national team leader, dont miss the opportunity to get your hands on one of these!', 289.99, 20);
-- Insert images for product_id = 10
INSERT INTO Product_Images (product_id, image_url) VALUES (10, 'assets/p_images/bota-adidas-predator-elite-ft-fg-jude-bellingham-silver-met-legacy-burgundy-maroon-0.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (10, 'assets/p_images/bota-adidas-predator-elite-ft-fg-jude-bellingham-silver-met-legacy-burgundy-maroon-1.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (10, 'assets/p_images/bota-adidas-predator-elite-ft-fg-jude-bellingham-silver-met-legacy-burgundy-maroon-2.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (10, 'assets/p_images/bota-adidas-predator-elite-ft-fg-jude-bellingham-silver-met-legacy-burgundy-maroon-3.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (10, 'assets/p_images/bota-adidas-predator-elite-ft-fg-jude-bellingham-silver-met-legacy-burgundy-maroon-4.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (10, 'assets/p_images/bota-adidas-predator-elite-ft-fg-jude-bellingham-silver-met-legacy-burgundy-maroon-5.webp');
INSERT INTO Product_Images (product_id, image_url) VALUES (10, 'assets/p_images/bota-adidas-predator-elite-ft-fg-jude-bellingham-silver-met-legacy-burgundy-maroon-6.webp');
