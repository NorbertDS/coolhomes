-- Real Kenyan Property Data from BuyRentKenya
-- This file contains actual property listings from Kenya's real estate market

USE coolhomes_db;

-- Clear existing properties (optional - comment out if you want to keep existing data)
-- DELETE FROM properties;

-- Insert real Kenyan properties
INSERT INTO properties (title, description, price, location, type, bedrooms, bathrooms, area, status, features, created_at) VALUES

-- Kitengela Properties
('Four-bedroom homes with detached DSQ', 
'This superb development consists of 78 four-bedroom homes with detached DSQ (en-suite). Located in the growing Kitengela area, these homes offer modern living with excellent amenities.',
18500000, 
'Kitengela', 
'house', 
4, 
3, 
2500, 
'available', 
'Detached DSQ, Modern Design, Gated Community, 24/7 Security, Swimming Pool, Children Play Area, Landscaped Gardens',
NOW()),

-- Lavington Properties  
('Alkira Apartments',
'Discover these 3 bedroom exclusive upscale development in the heart of Lavington. Premium location with modern amenities and excellent connectivity.',
150000,
'Lavington',
'apartment',
3,
2,
1800,
'available',
'Upscale Development, Premium Location, Modern Amenities, 24/7 Security, Swimming Pool, Gym, Parking',
NOW()),

-- Westlands Properties
('Greenville Gardens',
'Greenville Gardens is located along the exclusive General Mathenge Road in Westlands. This development offers luxury living with world-class amenities.',
16000000,
'General Mathenge, Westlands',
'house',
4,
4,
3000,
'available',
'Luxury Living, World-class Amenities, Gated Community, Swimming Pool, Gym, Landscaped Gardens, 24/7 Security',
NOW()),

('Gaia Brookside by Wonder Properties',
'Discover Luxury Living at Gaia Brookside! Nestled in the prestigious Brookside area of Westlands, this development offers 228 units of modern living.',
25000000,
'Brookside, Westlands',
'apartment',
3,
2,
2000,
'available',
'Luxury Living, Modern Design, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens, Children Play Area',
NOW()),

('Diplomat Residencies',
'Discover Diplomat Residencies - An exclusive development of 125 units located on Peponi Road, Westlands. Premium location with excellent amenities.',
5000000,
'Peponi Road, Westlands',
'apartment',
2,
2,
1200,
'available',
'Exclusive Development, Premium Location, Modern Amenities, Swimming Pool, Gym, 24/7 Security',
NOW()),

('Atreus Brookside',
'Welcome to ATREUS BROOKSIDE, the epitome of modern living in Brookside Grove, Westlands. This development offers 198 units with contemporary design.',
7900000,
'Brookside Grove, Westlands',
'apartment',
2,
2,
1500,
'available',
'Modern Living, Contemporary Design, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens',
NOW()),

-- Mombasa Properties
('Arcadia Cove Apartments',
'Welcome to Arcadia Cove Apartments, A family-friendly development located in Kizingo, Mombasa Island. This development offers 52 units with modern amenities.',
18000000,
'Kizingo, Mombasa Island',
'apartment',
3,
2,
1800,
'available',
'Family-friendly Development, Modern Amenities, Swimming Pool, Gym, 24/7 Security, Sea View',
NOW()),

-- Ruiru Properties
('143 Brookview - Membley',
'Welcome to 143 Brookview - an ultra-modern, exclusive development in Membley, Ruiru. This development offers 120 units with contemporary design.',
33000000,
'Membley, Ruiru',
'apartment',
3,
2,
2000,
'available',
'Ultra-modern Design, Exclusive Development, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens',
NOW()),

-- Thika Road Properties
('HERENCIA: PREMIUM GATED COMMUNITY',
'HERENCIA: PREMIUM GATED COMMUNITY strategically located at Bob Harris Road, Exit 16 off Thika Superhighway. This massive development offers 1000 units.',
4200000,
'Bob Harris Road, Thika Road',
'house',
3,
2,
1800,
'available',
'Premium Gated Community, Strategic Location, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens, Children Play Area',
NOW()),

('237 GARDEN CITY',
'237 by Mi Vida has been designed to provide a unique living experience in Garden City, Thika Road. This development offers 237 units with modern amenities.',
2900000,
'Garden City, Thika Road',
'apartment',
2,
2,
1200,
'available',
'Unique Living Experience, Modern Amenities, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens',
NOW()),

('Amaiya by Mi Vida',
'Amaiya by Mi Vida is the newest residential development on Thika Road. This development offers 108 units with contemporary design and modern amenities.',
9700000,
'Thika Road',
'apartment',
3,
2,
1800,
'available',
'Newest Development, Contemporary Design, Modern Amenities, Swimming Pool, Gym, 24/7 Security',
NOW()),

-- Ruaka Properties
('Keza Laika',
'KEZA Laika by Mi Vida brings a transformative touch to Ruaka. This development offers 120 units with modern design and excellent amenities.',
4800000,
'Ruaka',
'apartment',
2,
2,
1200,
'available',
'Transformative Design, Modern Amenities, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens',
NOW()),

-- Kilimani Properties
('Alba Apartments',
'1 bedroom apartment located in the heart of Kilimani. This development offers 200 units with modern amenities and excellent connectivity.',
80000,
'Kilimani',
'apartment',
1,
1,
800,
'available',
'Heart of Kilimani, Modern Amenities, Swimming Pool, Gym, 24/7 Security, Excellent Connectivity',
NOW()),

-- Kileleshwa Properties
('Golden Street Residency',
'Golden Street Development Ltd is delighted to present Golden Street Residency in Kileleshwa. This development offers 338 units with luxury amenities.',
9000000,
'Kileleshwa',
'apartment',
3,
2,
1800,
'available',
'Luxury Amenities, Swimming Pool, Gym, 24/7 Security, Landscaped Gardens, Children Play Area',
NOW()),

-- Ongata Rongai Properties
('Ecovale Apartments',
'Ecovale Apartments, located in the serene enclave of Ongata Rongai. This development offers 127 units with modern amenities and peaceful living.',
3300000,
'Ongata Rongai',
'apartment',
2,
2,
1200,
'available',
'Serene Location, Modern Amenities, Swimming Pool, Gym, 24/7 Security, Peaceful Living',
NOW()),

-- Commercial Properties
('Fully Furnished Office in Westlands',
'Fully furnished spaces equipped with furniture, fixtures, and equipment. Located in the heart of Westlands business district.',
75000000,
'Westlands Area, Westlands',
'commercial',
0,
0,
5500,
'available',
'Fully Furnished, Business District Location, Modern Office Space, 24/7 Security, Parking',
NOW());

-- Update property images (you would need to add actual image URLs)
-- For now, we'll use placeholder images
UPDATE properties SET images = JSON_ARRAY(
    'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800&h=600&fit=crop',
    'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800&h=600&fit=crop',
    'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800&h=600&fit=crop'
) WHERE id > 0;

-- Add some rental properties
INSERT INTO properties (title, description, price, location, type, bedrooms, bathrooms, area, status, features, created_at) VALUES

('Springsden Apartments',
'These spacious 2 bedroom apartments are situated on Waiyaki Way, Westlands. Modern amenities with excellent connectivity to the city center.',
60000,
'Waiyaki Way, Westlands',
'apartment',
2,
2,
1200,
'available',
'Spacious Apartments, Modern Amenities, Excellent Connectivity, Swimming Pool, Gym, 24/7 Security',
NOW()),

('The Loftel Rentals',
'Nestled around the bustling heart of Ruaka Town, The Loftel offers modern living with excellent amenities and connectivity.',
75000,
'Ruaka',
'apartment',
1,
1,
800,
'available',
'Modern Living, Excellent Amenities, Swimming Pool, Gym, 24/7 Security, Great Connectivity',
NOW());

-- Add some land properties
INSERT INTO properties (title, description, price, location, type, bedrooms, bathrooms, area, status, features, created_at) VALUES

('Plainsview Estate',
'Beautifully designed 3 Bedroom Bungalows each sitting on a 1/8 acre plot in Kitengela. Perfect for families looking for spacious living.',
5500000,
'Kitengela',
'house',
3,
2,
2000,
'available',
'1/8 Acre Plot, Spacious Living, Family-friendly, Gated Community, 24/7 Security, Landscaped Gardens',
NOW());
