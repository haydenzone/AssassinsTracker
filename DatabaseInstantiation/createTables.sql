CREATE TABLE Member
(
StudentID int,
LastName varchar(255),
FirstName varchar(255),
Email varchar(255),
PhoneNum varchar(10),
TextEmail varchar(255),
ImageLoc varchar(255),
Password BLOB,
Admin tinyint(1),
PRIMARY KEY (StudentID)
);

CREATE TABLE Player
(
StudentID int,
AdminConf int NOT NULL,
TargetID int,
LifeID varchar(255),
Kills int,
Lives int,
LastActivity datetime,
PRIMARY KEY (StudentID),
FOREIGN KEY (TargetID) REFERENCES Member(StudentID),
FOREIGN KEY (AdminConf) REFERENCES Member(StudentID)
);

CREATE TABLE TextConf
(
StudentID int,
ConfCode int,
PRIMARY KEY (StudentID),
FOREIGN KEY (StudentID) REFERENCES Member(StudentID) ON DELETE CASCADE
);

CREATE TABLE RandomWord
(
id int NOT NULL AUTO_INCREMENT,
word varchar(40) NOT NULL,
PRIMARY KEY (id)
);
CREATE TABLE RandomColor
(
id int NOT NULL AUTO_INCREMENT,
color varchar(40) NOT NULL,
PRIMARY KEY (id)
);

INSERT INTO randomword(word) VALUES ('Adult');
INSERT INTO randomword(word) VALUES ('Aeroplane');
INSERT INTO randomword(word) VALUES ('Air');
INSERT INTO randomword(word) VALUES ('Aircraft');
INSERT INTO randomword(word) VALUES ('Airforce');
INSERT INTO randomword(word) VALUES ('Airport');
INSERT INTO randomword(word) VALUES ('Album');
INSERT INTO randomword(word) VALUES ('Alphabet');
INSERT INTO randomword(word) VALUES ('Apple');
INSERT INTO randomword(word) VALUES ('Arm');
INSERT INTO randomword(word) VALUES ('Army');
INSERT INTO randomword(word) VALUES ('Baby');
INSERT INTO randomword(word) VALUES ('Baby');
INSERT INTO randomword(word) VALUES ('Backpack');
INSERT INTO randomword(word) VALUES ('Balloon');
INSERT INTO randomword(word) VALUES ('Banana');
INSERT INTO randomword(word) VALUES ('Bank');
INSERT INTO randomword(word) VALUES ('Barbecue');
INSERT INTO randomword(word) VALUES ('Bathroom');
INSERT INTO randomword(word) VALUES ('Bathtub');
INSERT INTO randomword(word) VALUES ('Bed');
INSERT INTO randomword(word) VALUES ('Bee');
INSERT INTO randomword(word) VALUES ('Bible');
INSERT INTO randomword(word) VALUES ('Bible');
INSERT INTO randomword(word) VALUES ('Bird');
INSERT INTO randomword(word) VALUES ('Bomb');
INSERT INTO randomword(word) VALUES ('Book');
INSERT INTO randomword(word) VALUES ('Boss');
INSERT INTO randomword(word) VALUES ('Bottle');
INSERT INTO randomword(word) VALUES ('Bowl');
INSERT INTO randomword(word) VALUES ('Box');
INSERT INTO randomword(word) VALUES ('Boy');
INSERT INTO randomword(word) VALUES ('Brain');
INSERT INTO randomword(word) VALUES ('Bridge');
INSERT INTO randomword(word) VALUES ('Butterfly');
INSERT INTO randomword(word) VALUES ('Button');
INSERT INTO randomword(word) VALUES ('Cappuccino');
INSERT INTO randomword(word) VALUES ('Car');
INSERT INTO randomword(word) VALUES ('Car-race');
INSERT INTO randomword(word) VALUES ('Carpet');
INSERT INTO randomword(word) VALUES ('Carrot');
INSERT INTO randomword(word) VALUES ('Cave');
INSERT INTO randomword(word) VALUES ('Chair');
INSERT INTO randomword(word) VALUES ('Chess');
INSERT INTO randomword(word) VALUES ('Chief');
INSERT INTO randomword(word) VALUES ('Child');
INSERT INTO randomword(word) VALUES ('Chisel');
INSERT INTO randomword(word) VALUES ('Chocolates');
INSERT INTO randomword(word) VALUES ('Church');
INSERT INTO randomword(word) VALUES ('Church');
INSERT INTO randomword(word) VALUES ('Circle');
INSERT INTO randomword(word) VALUES ('Circus');
INSERT INTO randomword(word) VALUES ('Circus');
INSERT INTO randomword(word) VALUES ('Clock');
INSERT INTO randomword(word) VALUES ('Clown');
INSERT INTO randomword(word) VALUES ('Coffee');
INSERT INTO randomword(word) VALUES ('Coffee-shop');
INSERT INTO randomword(word) VALUES ('Comet');
INSERT INTO randomword(word) VALUES ('Disc');
INSERT INTO randomword(word) VALUES ('Compass');
INSERT INTO randomword(word) VALUES ('Computer');
INSERT INTO randomword(word) VALUES ('Crystal');
INSERT INTO randomword(word) VALUES ('Cup');
INSERT INTO randomword(word) VALUES ('Cycle');
INSERT INTO randomword(word) VALUES ('Desk');
INSERT INTO randomword(word) VALUES ('Diamond');
INSERT INTO randomword(word) VALUES ('Dress');
INSERT INTO randomword(word) VALUES ('Drill');
INSERT INTO randomword(word) VALUES ('Drink');
INSERT INTO randomword(word) VALUES ('Drum');
INSERT INTO randomword(word) VALUES ('Dung');
INSERT INTO randomword(word) VALUES ('Ears');
INSERT INTO randomword(word) VALUES ('Earth');
INSERT INTO randomword(word) VALUES ('Egg');
INSERT INTO randomword(word) VALUES ('Electricity');
INSERT INTO randomword(word) VALUES ('Elephant');
INSERT INTO randomword(word) VALUES ('Eraser');
INSERT INTO randomword(word) VALUES ('Explosive');
INSERT INTO randomword(word) VALUES ('Eyes');
INSERT INTO randomword(word) VALUES ('Family');
INSERT INTO randomword(word) VALUES ('Fan');
INSERT INTO randomword(word) VALUES ('Feather');
INSERT INTO randomword(word) VALUES ('Festival');
INSERT INTO randomword(word) VALUES ('Film');
INSERT INTO randomword(word) VALUES ('Finger');
INSERT INTO randomword(word) VALUES ('Fire');
INSERT INTO randomword(word) VALUES ('Floodlight');
INSERT INTO randomword(word) VALUES ('Flower');
INSERT INTO randomword(word) VALUES ('Foot');
INSERT INTO randomword(word) VALUES ('Fork');
INSERT INTO randomword(word) VALUES ('Freeway');
INSERT INTO randomword(word) VALUES ('Fruit');
INSERT INTO randomword(word) VALUES ('Fungus');
INSERT INTO randomword(word) VALUES ('Game');
INSERT INTO randomword(word) VALUES ('Garden');
INSERT INTO randomword(word) VALUES ('Gas');
INSERT INTO randomword(word) VALUES ('Gate');
INSERT INTO randomword(word) VALUES ('Gemstone');
INSERT INTO randomword(word) VALUES ('Girl');
INSERT INTO randomword(word) VALUES ('Gloves');
INSERT INTO randomword(word) VALUES ('God');
INSERT INTO randomword(word) VALUES ('Grapes');
INSERT INTO randomword(word) VALUES ('Guitar');
INSERT INTO randomword(word) VALUES ('Hammer');
INSERT INTO randomword(word) VALUES ('Hat');
INSERT INTO randomword(word) VALUES ('Hieroglyph');
INSERT INTO randomword(word) VALUES ('Highway');
INSERT INTO randomword(word) VALUES ('Horoscope');
INSERT INTO randomword(word) VALUES ('Horse');
INSERT INTO randomword(word) VALUES ('Hose');
INSERT INTO randomword(word) VALUES ('Ice');
INSERT INTO randomword(word) VALUES ('Ice-cream');
INSERT INTO randomword(word) VALUES ('Insect');
INSERT INTO randomword(word) VALUES ('Jet');
INSERT INTO randomword(word) VALUES ('Junk');
INSERT INTO randomword(word) VALUES ('Kaleidoscope');
INSERT INTO randomword(word) VALUES ('Kitchen');
INSERT INTO randomword(word) VALUES ('Knife');
INSERT INTO randomword(word) VALUES ('Leather');
INSERT INTO randomword(word) VALUES ('Jacket');
INSERT INTO randomword(word) VALUES ('Leg');
INSERT INTO randomword(word) VALUES ('Library');
INSERT INTO randomword(word) VALUES ('Liquid');
INSERT INTO randomword(word) VALUES ('Magnet');
INSERT INTO randomword(word) VALUES ('Man');
INSERT INTO randomword(word) VALUES ('Map');
INSERT INTO randomword(word) VALUES ('Maze');
INSERT INTO randomword(word) VALUES ('Meat');
INSERT INTO randomword(word) VALUES ('Meteor');
INSERT INTO randomword(word) VALUES ('Microscope');
INSERT INTO randomword(word) VALUES ('Milk');
INSERT INTO randomword(word) VALUES ('Milkshake');
INSERT INTO randomword(word) VALUES ('Mist');
INSERT INTO randomword(word) VALUES ('Money');
INSERT INTO randomword(word) VALUES ('Monster');
INSERT INTO randomword(word) VALUES ('Mosquito');
INSERT INTO randomword(word) VALUES ('Mouth');
INSERT INTO randomword(word) VALUES ('Nail');
INSERT INTO randomword(word) VALUES ('Navy');
INSERT INTO randomword(word) VALUES ('Necklace');
INSERT INTO randomword(word) VALUES ('Needle');
INSERT INTO randomword(word) VALUES ('Onion');
INSERT INTO randomword(word) VALUES ('PaintBrush');
INSERT INTO randomword(word) VALUES ('Pants');
INSERT INTO randomword(word) VALUES ('Parachute');
INSERT INTO randomword(word) VALUES ('Passport');
INSERT INTO randomword(word) VALUES ('Pebble');
INSERT INTO randomword(word) VALUES ('Pendulum');
INSERT INTO randomword(word) VALUES ('Pepper');
INSERT INTO randomword(word) VALUES ('Perfume');
INSERT INTO randomword(word) VALUES ('Pillow');
INSERT INTO randomword(word) VALUES ('Plane');
INSERT INTO randomword(word) VALUES ('Planet');
INSERT INTO randomword(word) VALUES ('Pocket');
INSERT INTO randomword(word) VALUES ('Post-office');
INSERT INTO randomword(word) VALUES ('Potato');
INSERT INTO randomword(word) VALUES ('Printer');
INSERT INTO randomword(word) VALUES ('Prison');
INSERT INTO randomword(word) VALUES ('Pyramid');
INSERT INTO randomword(word) VALUES ('Radar');
INSERT INTO randomword(word) VALUES ('Rainbow');
INSERT INTO randomword(word) VALUES ('Record');
INSERT INTO randomword(word) VALUES ('Restaurant');
INSERT INTO randomword(word) VALUES ('Rifle');
INSERT INTO randomword(word) VALUES ('Ring');
INSERT INTO randomword(word) VALUES ('Robot');
INSERT INTO randomword(word) VALUES ('Rock');
INSERT INTO randomword(word) VALUES ('Rocket');
INSERT INTO randomword(word) VALUES ('Roof');
INSERT INTO randomword(word) VALUES ('Room');
INSERT INTO randomword(word) VALUES ('Rope');
INSERT INTO randomword(word) VALUES ('Saddle');
INSERT INTO randomword(word) VALUES ('Salt');
INSERT INTO randomword(word) VALUES ('Sandpaper');
INSERT INTO randomword(word) VALUES ('Sandwich');
INSERT INTO randomword(word) VALUES ('Satellite');
INSERT INTO randomword(word) VALUES ('School');
INSERT INTO randomword(word) VALUES ('Sex');
INSERT INTO randomword(word) VALUES ('Ship');
INSERT INTO randomword(word) VALUES ('Shoes');
INSERT INTO randomword(word) VALUES ('Shop');
INSERT INTO randomword(word) VALUES ('Shower');
INSERT INTO randomword(word) VALUES ('Signature');
INSERT INTO randomword(word) VALUES ('Skeleton');
INSERT INTO randomword(word) VALUES ('Slave');
INSERT INTO randomword(word) VALUES ('Snail');
INSERT INTO randomword(word) VALUES ('Software');
INSERT INTO randomword(word) VALUES ('Solid');
INSERT INTO randomword(word) VALUES ('Space');
INSERT INTO randomword(word) VALUES ('Shuttle');
INSERT INTO randomword(word) VALUES ('Spectrum');
INSERT INTO randomword(word) VALUES ('Sphere');
INSERT INTO randomword(word) VALUES ('Spice');
INSERT INTO randomword(word) VALUES ('Spiral');
INSERT INTO randomword(word) VALUES ('Spoon');
INSERT INTO randomword(word) VALUES ('Sports-car');
INSERT INTO randomword(word) VALUES ('Spot');
INSERT INTO randomword(word) VALUES ('Light');
INSERT INTO randomword(word) VALUES ('Square');
INSERT INTO randomword(word) VALUES ('Staircase');
INSERT INTO randomword(word) VALUES ('Star');
INSERT INTO randomword(word) VALUES ('Stomach');
INSERT INTO randomword(word) VALUES ('Sun');
INSERT INTO randomword(word) VALUES ('Sunglasses');
INSERT INTO randomword(word) VALUES ('Surveyor');
INSERT INTO randomword(word) VALUES ('Swimming');
INSERT INTO randomword(word) VALUES ('Pool');
INSERT INTO randomword(word) VALUES ('Sword');
INSERT INTO randomword(word) VALUES ('Table');
INSERT INTO randomword(word) VALUES ('Tapestry');
INSERT INTO randomword(word) VALUES ('Teeth');
INSERT INTO randomword(word) VALUES ('Telescope');
INSERT INTO randomword(word) VALUES ('Television');
INSERT INTO randomword(word) VALUES ('Racquet');
INSERT INTO randomword(word) VALUES ('Thermometer');
INSERT INTO randomword(word) VALUES ('Tiger');
INSERT INTO randomword(word) VALUES ('Toilet');
INSERT INTO randomword(word) VALUES ('Tongue');
INSERT INTO randomword(word) VALUES ('Torch');
INSERT INTO randomword(word) VALUES ('Torpedo');
INSERT INTO randomword(word) VALUES ('Train');
INSERT INTO randomword(word) VALUES ('Treadmill');
INSERT INTO randomword(word) VALUES ('Triangle');
INSERT INTO randomword(word) VALUES ('Tunnel');
INSERT INTO randomword(word) VALUES ('Typewriter');
INSERT INTO randomword(word) VALUES ('Umbrella');
INSERT INTO randomword(word) VALUES ('Vacuum');
INSERT INTO randomword(word) VALUES ('Vampire');
INSERT INTO randomword(word) VALUES ('Videotape');
INSERT INTO randomword(word) VALUES ('Vulture');
INSERT INTO randomword(word) VALUES ('Water');
INSERT INTO randomword(word) VALUES ('Weapon');
INSERT INTO randomword(word) VALUES ('Web');
INSERT INTO randomword(word) VALUES ('Wheelchair');
INSERT INTO randomword(word) VALUES ('Window');
INSERT INTO randomword(word) VALUES ('Woman');
INSERT INTO randomword(word) VALUES ('Worm');
INSERT INTO randomword(word) VALUES ('Xray');

INSERT INTO randomcolor(color) VALUES ('Blue');
INSERT INTO randomcolor(color) VALUES ('Green');
INSERT INTO randomcolor(color) VALUES ('Yellow');
INSERT INTO randomcolor(color) VALUES ('Brown');
INSERT INTO randomcolor(color) VALUES ('Red');
INSERT INTO randomcolor(color) VALUES ('Purple');
INSERT INTO randomcolor(color) VALUES ('Gray');
INSERT INTO randomcolor(color) VALUES ('Black');
INSERT INTO randomcolor(color) VALUES ('White');

