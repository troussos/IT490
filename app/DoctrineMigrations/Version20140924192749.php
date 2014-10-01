<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

use Group3\Bundle\ABundle\Entity\Customer;
use Group3\Bundle\ABundle\Entity\Inventory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Version20140924192749 extends AbstractMigration implements ContainerAwareInterface
{
    private static $customersArray = array(
        array('first'=>'Salvador','last'=>'Mercer','email'=>'orci.consectetuer.euismod@dui.edu','street'=>'523-4425 Eu Rd.','city'=>'Biała Podlaska','state'=>'LU','zip'=>'3212KU','country'=>'Heard Island and Mcdonald Islands'),
        array('first'=>'Elijah','last'=>'Porter','email'=>'sociosqu.ad@aliquetdiam.co.uk','street'=>'P.O. Box 126, 7159 Netus Road','city'=>'Legnica','state'=>'DS','zip'=>'05448','country'=>'Namibia'),
        array('first'=>'Porter','last'=>'Noel','email'=>'Integer@sed.edu','street'=>'461-9368 Mauris Av.','city'=>'Assiniboia','state'=>'Saskatchewan','zip'=>'6106','country'=>'French Guiana'),
        array('first'=>'Abdul','last'=>'Savage','email'=>'et.rutrum.non@fringilla.com','street'=>'Ap #577-3201 Malesuada Ave','city'=>'Port Augusta','state'=>'SA','zip'=>'5822','country'=>'Gambia'),
        array('first'=>'Jonah','last'=>'Hawkins','email'=>'interdum.enim@sit.net','street'=>'Ap #735-5135 Eleifend. St.','city'=>'Moose Jaw','state'=>'Saskatchewan','zip'=>'62371','country'=>'Vanuatu'),
        array('first'=>'Ross','last'=>'Lynn','email'=>'enim.Suspendisse.aliquet@sapien.org','street'=>'Ap #352-575 A St.','city'=>'Mandi Bahauddin','state'=>'PB','zip'=>'3274JD','country'=>'Virgin Islands, British'),
        array('first'=>'Phelan','last'=>'Ayala','email'=>'Nunc.ac@hendreritidante.org','street'=>'902-1803 Molestie. Avenue','city'=>'San Vicente','state'=>'SJ','zip'=>'5888','country'=>'Latvia'),
        array('first'=>'Dennis','last'=>'Parsons','email'=>'lectus.ante.dictum@consequatdolor.ca','street'=>'Ap #179-8076 Bibendum. Avenue','city'=>'Imphal','state'=>'Manipur','zip'=>'54614','country'=>'Colombia'),
        array('first'=>'Palmer','last'=>'Winters','email'=>'in@malesuadaInteger.ca','street'=>'5856 Mi Av.','city'=>'Onitsha','state'=>'AN','zip'=>'94790','country'=>'Honduras'),
        array('first'=>'Otto','last'=>'Harmon','email'=>'Curabitur@anunc.ca','street'=>'Ap #857-3569 Sed St.','city'=>'Berlin','state'=>'Berlin','zip'=>'M9M 6R7','country'=>'Faroe Islands'),
        array('first'=>'Dennis','last'=>'Kline','email'=>'egestas.nunc.sed@eratnonummyultricies.edu','street'=>'717-9068 Et Road','city'=>'Castelmarte','state'=>'LO','zip'=>'Y5 2KH','country'=>'China'),
        array('first'=>'Dale','last'=>'Reynolds','email'=>'sed.pede@egestasrhoncusProin.net','street'=>'P.O. Box 885, 6328 Phasellus St.','city'=>'Logan City','state'=>'QL','zip'=>'82523','country'=>'New Caledonia'),
        array('first'=>'Malik','last'=>'Lindsey','email'=>'pharetra@ipsumSuspendisse.co.uk','street'=>'122-9434 Vitae St.','city'=>'Cawdor','state'=>'Nairnshire','zip'=>'76942','country'=>'Gibraltar'),
        array('first'=>'Benedict','last'=>'Richardson','email'=>'elit@ategestas.co.uk','street'=>'Ap #144-816 Quisque Avenue','city'=>'Mango','state'=>'JH','zip'=>'4335IW','country'=>'Algeria'),
        array('first'=>'Leroy','last'=>'Solis','email'=>'arcu.Nunc.mauris@lobortisultricesVivamus.co.uk','street'=>'P.O. Box 491, 6272 Id Ave','city'=>'Morrinsville','state'=>'North Island','zip'=>'3953','country'=>'Czech Republic'),
        array('first'=>'Basil','last'=>'Macdonald','email'=>'Nulla.facilisi@feugiattellus.edu','street'=>'P.O. Box 239, 4074 Penatibus St.','city'=>'Bairnsdale','state'=>'VI','zip'=>'9858','country'=>'Montserrat'),
        array('first'=>'Dustin','last'=>'Sullivan','email'=>'sem@veliteu.com','street'=>'9471 Suspendisse Street','city'=>'Kano','state'=>'Kano','zip'=>'51835','country'=>'Cameroon'),
        array('first'=>'Silas','last'=>'Meyers','email'=>'Nunc@purusmaurisa.net','street'=>'Ap #710-4223 Egestas St.','city'=>'St. Petersburg','state'=>'FL','zip'=>'70007','country'=>'Virgin Islands, United States'),
        array('first'=>'Kyle','last'=>'Harding','email'=>'eu.euismod.ac@parturient.org','street'=>'339-7464 Facilisis Street','city'=>'Vienna','state'=>'Vienna','zip'=>'26314','country'=>'Mexico'),
        array('first'=>'Francis','last'=>'Estrada','email'=>'sit.amet.consectetuer@nec.co.uk','street'=>'Ap #250-883 Sit St.','city'=>'Mission','state'=>'BC','zip'=>'60400','country'=>'Germany'),
        array('first'=>'Cullen','last'=>'Benjamin','email'=>'semper@duisemper.ca','street'=>'3355 Vivamus Road','city'=>'Waiuku','state'=>'North Island','zip'=>'72730-987','country'=>'Cambodia'),
        array('first'=>'Talon','last'=>'Mcleod','email'=>'Fusce.aliquet@condimentumegetvolutpat.co.uk','street'=>'Ap #917-5194 Aliquet, Ave','city'=>'Saint-L�ger','state'=>'Luxemburg','zip'=>'62177','country'=>'Dominican Republic'),
        array('first'=>'Brent','last'=>'Durham','email'=>'ac.ipsum@incursuset.ca','street'=>'7223 Arcu Rd.','city'=>'Fochabers','state'=>'Morayshire','zip'=>'80-440','country'=>'Bhutan'),
        array('first'=>'Ciaran','last'=>'Franco','email'=>'ac.arcu@utpellentesqueeget.co.uk','street'=>'556-3567 Mollis. Rd.','city'=>'Hilo','state'=>'Hawaii','zip'=>'7913','country'=>'Swaziland'),
        array('first'=>'Thane','last'=>'Dalton','email'=>'lorem.auctor@Duisvolutpat.org','street'=>'Ap #485-8199 Sapien. Ave','city'=>'Bairnsdale','state'=>'VI','zip'=>'19507','country'=>'Belgium'),
        array('first'=>'Carson','last'=>'Buchanan','email'=>'arcu@nisisemsemper.edu','street'=>'826-4969 Accumsan St.','city'=>'Tczew','state'=>'Pomorskie','zip'=>'Q32 3GM','country'=>'Nauru'),
        array('first'=>'Kermit','last'=>'Cole','email'=>'luctus.aliquet@Maecenasmifelis.edu','street'=>'P.O. Box 922, 4378 Gravida Avenue','city'=>'Matamata','state'=>'NI','zip'=>'70-030','country'=>'Taiwan'),
        array('first'=>'Beau','last'=>'Kidd','email'=>'elit@egetmetuseu.com','street'=>'456-2085 Magna Av.','city'=>'Bremerhaven','state'=>'HB','zip'=>'64812','country'=>'Iran'),
        array('first'=>'Zeus','last'=>'Gamble','email'=>'metus.urna.convallis@dictummagnaUt.edu','street'=>'Ap #183-9230 Porttitor Rd.','city'=>'Huissen','state'=>'Gelderland','zip'=>'97256','country'=>'Christmas Island'),
        array('first'=>'Alfonso','last'=>'Mcdonald','email'=>'libero.est.congue@semperduilectus.org','street'=>'Ap #670-485 Risus. Avenue','city'=>'Bloomington','state'=>'MN','zip'=>'78761','country'=>'Kyrgyzstan'),
        array('first'=>'Nissim','last'=>'Lloyd','email'=>'velit.dui.semper@Sednuncest.ca','street'=>'351-2509 Dolor Street','city'=>'Quesada','state'=>'A','zip'=>'A6Z 9P7','country'=>'Trinidad and Tobago'),
        array('first'=>'Ivan','last'=>'Good','email'=>'a.sollicitudin.orci@justonec.org','street'=>'Ap #737-6961 Elit. Av.','city'=>'Maiduguri','state'=>'BO','zip'=>'892065','country'=>'Panama'),
        array('first'=>'Melvin','last'=>'Harmon','email'=>'ut@atpedeCras.edu','street'=>'P.O. Box 525, 1616 Dui St.','city'=>'Rocca Massima','state'=>'Lazio','zip'=>'8444','country'=>'United States Minor Outlying Islands'),
        array('first'=>'Ulysses','last'=>'Mcgowan','email'=>'enim.mi@semPellentesque.ca','street'=>'Ap #482-3738 Massa. Ave','city'=>'Abeokuta','state'=>'OG','zip'=>'7393','country'=>'Mozambique'),
        array('first'=>'Jin','last'=>'Campbell','email'=>'non@loremsemper.com','street'=>'Ap #509-4590 A Road','city'=>'Issy-les-Moulineaux','state'=>'Île-de-France','zip'=>'15873','country'=>'Macedonia'),
        array('first'=>'Alfonso','last'=>'Logan','email'=>'eleifend.nec.malesuada@nuncrisus.net','street'=>'988-2574 Vitae St.','city'=>'Vienna','state'=>'Wi','zip'=>'104678','country'=>'Finland'),
        array('first'=>'Amal','last'=>'Hines','email'=>'sem.Nulla@temporbibendumDonec.com','street'=>'292-2922 Ipsum. Rd.','city'=>'Algeciras','state'=>'AN','zip'=>'10081','country'=>'Gambia'),
        array('first'=>'Zeph','last'=>'Keith','email'=>'congue.In@dolornonummyac.net','street'=>'Ap #916-6209 Erat. Road','city'=>'Katowice','state'=>'SL','zip'=>'242643','country'=>'French Southern Territories'),
        array('first'=>'Oren','last'=>'Smith','email'=>'Ut.tincidunt@in.org','street'=>'230-3098 Primis Rd.','city'=>'Ilesa','state'=>'Osun','zip'=>'95347','country'=>'Netherlands'),
        array('first'=>'Brennan','last'=>'Bentley','email'=>'amet@molestie.co.uk','street'=>'7632 Nunc St.','city'=>'Mussy-la-Ville','state'=>'LX','zip'=>'L55 9GN','country'=>'Timor-Leste'),
        array('first'=>'Ronan','last'=>'Norman','email'=>'sed@ut.net','street'=>'P.O. Box 875, 7574 Ut, Street','city'=>'L?vis','state'=>'QC','zip'=>'64-765','country'=>'Denmark'),
        array('first'=>'Derek','last'=>'Wall','email'=>'eu@justofaucibuslectus.co.uk','street'=>'Ap #779-4031 Sociis Rd.','city'=>'Lacombe','state'=>'Alberta','zip'=>'230883','country'=>'Cayman Islands'),
        array('first'=>'Elijah','last'=>'Hudson','email'=>'ut.pharetra.sed@temporbibendum.co.uk','street'=>'8018 Tempor Road','city'=>'Tarnów','state'=>'Małopolskie','zip'=>'1041','country'=>'Mali'),
        array('first'=>'Wesley','last'=>'Mcmillan','email'=>'Integer.eu@nequesedsem.edu','street'=>'6418 Sit Ave','city'=>'Dibrugarh','state'=>'AS','zip'=>'56522','country'=>'Bangladesh'),
        array('first'=>'Yuli','last'=>'Oliver','email'=>'sit@pharetranibh.co.uk','street'=>'6760 Nonummy Av.','city'=>'Greater Sudbury','state'=>'ON','zip'=>'79-674','country'=>'Saint Barthélemy'),
        array('first'=>'Cadman','last'=>'Franklin','email'=>'tellus.justo.sit@Suspendissealiquet.org','street'=>'619-7973 Phasellus Road','city'=>'Metairie','state'=>'LA','zip'=>'N3Y 0M3','country'=>'Iran'),
        array('first'=>'Hall','last'=>'Ortiz','email'=>'sagittis@ligulaAenean.org','street'=>'968-7679 Phasellus Avenue','city'=>'Liberia','state'=>'Guanacaste','zip'=>'22927-717','country'=>'Namibia'),
        array('first'=>'Evan','last'=>'Goodman','email'=>'Nulla@ultricies.ca','street'=>'Ap #282-6908 Aliquam Rd.','city'=>'Bognor Regis','state'=>'Sussex','zip'=>'672317','country'=>'Wallis and Futuna'),
        array('first'=>'Caesar','last'=>'Joyce','email'=>'Mauris.vestibulum@ornareplaceratorci.net','street'=>'P.O. Box 492, 678 Sapien, Avenue','city'=>'Oudekapelle','state'=>'West-Vlaanderen','zip'=>'N3 9OV','country'=>'Turks and Caicos Islands'),
        array('first'=>'Dylan','last'=>'Howell','email'=>'vitae.aliquam@lectusNullamsuscipit.ca','street'=>'6000 Amet, St.','city'=>'Sydney','state'=>'NS','zip'=>'669291','country'=>'Mauritania'),
        array('first'=>'Eaton','last'=>'Price','email'=>'ultrices.posuere.cubilia@posuerecubilia.net','street'=>'467-7304 Sem Ave','city'=>'Sunderland','state'=>'Durham','zip'=>'50304','country'=>'Cyprus'),
        array('first'=>'Rahim','last'=>'Delgado','email'=>'et@maurisutmi.co.uk','street'=>'6128 Egestas. Rd.','city'=>'Hamburg','state'=>'HH','zip'=>'645272','country'=>'Cuba'),
        array('first'=>'Carl','last'=>'Gomez','email'=>'urna@convallisincursus.org','street'=>'P.O. Box 804, 456 Aliquet Street','city'=>'Armidale','state'=>'New South Wales','zip'=>'Y9A 0LK','country'=>'South Sudan'),
        array('first'=>'Thomas','last'=>'Mercer','email'=>'nibh.enim.gravida@convallis.org','street'=>'886-8943 Sociis Rd.','city'=>'Mata de Plátano','state'=>'SJ','zip'=>'39670','country'=>'Western Sahara'),
        array('first'=>'Cameron','last'=>'Briggs','email'=>'ultrices.a.auctor@metusAeneansed.org','street'=>'2130 Libero Road','city'=>'Opwijk','state'=>'VB','zip'=>'26975','country'=>'Taiwan'),
        array('first'=>'Plato','last'=>'Petty','email'=>'et@Aliquamfringillacursus.ca','street'=>'891-6302 Mauris Avenue','city'=>'Meppel','state'=>'Dr','zip'=>'81823','country'=>'Virgin Islands, British'),
        array('first'=>'Victor','last'=>'Mcclure','email'=>'cursus.et@enimEtiamgravida.com','street'=>'P.O. Box 565, 3588 Eu Rd.','city'=>'College','state'=>'Alaska','zip'=>'20110-179','country'=>'Romania'),
        array('first'=>'Felix','last'=>'Haney','email'=>'Nulla@lectusante.com','street'=>'Ap #521-6651 Egestas, St.','city'=>'San Jose','state'=>'CA','zip'=>'34731-436','country'=>'South Georgia and The South Sandwich Islands'),
        array('first'=>'Isaiah','last'=>'Ellison','email'=>'Fusce@rutrum.com','street'=>'9566 Suspendisse Av.','city'=>'Mandasor','state'=>'MP','zip'=>'90-046','country'=>'Mongolia'),
        array('first'=>'Guy','last'=>'Cochran','email'=>'dolor.Fusce@commodoauctor.com','street'=>'9866 Amet, Avenue','city'=>'Wagga Wagga','state'=>'NS','zip'=>'820451','country'=>'Oman'),
        array('first'=>'Brady','last'=>'Gardner','email'=>'nulla.Integer.urna@Quisqueliberolacus.ca','street'=>'8376 Quis Rd.','city'=>'Memphis','state'=>'Tennessee','zip'=>'62819','country'=>'Solomon Islands'),
        array('first'=>'Raymond','last'=>'Coffey','email'=>'lacus.Quisque.purus@eueuismod.co.uk','street'=>'3483 Nec St.','city'=>'Quesada','state'=>'A','zip'=>'7369','country'=>'Romania'),
        array('first'=>'Steel','last'=>'Oliver','email'=>'egestas.Fusce.aliquet@afelisullamcorper.edu','street'=>'Ap #505-9954 Ipsum Av.','city'=>'Dhanbad','state'=>'Jharkhand','zip'=>'4421VV','country'=>'Argentina'),
        array('first'=>'Nigel','last'=>'Williams','email'=>'sed.hendrerit.a@augue.net','street'=>'Ap #687-7322 Pellentesque Ave','city'=>'Vienna','state'=>'Vienna','zip'=>'42-105','country'=>'Palau'),
        array('first'=>'Derek','last'=>'Mason','email'=>'porttitor.interdum@malesuadaIntegerid.net','street'=>'1519 Porta Av.','city'=>'Ercolano','state'=>'CA','zip'=>'2344','country'=>'Tajikistan'),
        array('first'=>'Warren','last'=>'Rice','email'=>'non.feugiat@luctusCurabitur.co.uk','street'=>'817 Vitae Av.','city'=>'Baie-dUrf','state'=>'Quebec','zip'=>'J3V 1T2','country'=>'Hong Kong'),
        array('first'=>'Troy','last'=>'Sharpe','email'=>'est@ultricesposuere.net','street'=>'Ap #717-1671 Nisi St.','city'=>'Porbandar','state'=>'GJ','zip'=>'40936','country'=>'China'),
        array('first'=>'Ivor','last'=>'George','email'=>'Sed.malesuada.augue@enimMauris.com','street'=>'566-6740 Erat Street','city'=>'Konin','state'=>'Wielkopolskie','zip'=>'0507','country'=>'Hong Kong'),
        array('first'=>'Charles','last'=>'Pope','email'=>'ac@erat.co.uk','street'=>'P.O. Box 778, 3798 Quis Avenue','city'=>'Bydgoszcz','state'=>'KP','zip'=>'526132','country'=>'Belize'),
        array('first'=>'Oscar','last'=>'Bartlett','email'=>'tempor.diam.dictum@placeratCras.co.uk','street'=>'P.O. Box 213, 280 Turpis. Road','city'=>'Whitehorse','state'=>'Yukon','zip'=>'22260','country'=>'Northern Mariana Islands'),
        array('first'=>'Cole','last'=>'Ramsey','email'=>'Quisque.ornare.tortor@enimMauris.edu','street'=>'3667 Pretium Road','city'=>'Baracaldo','state'=>'Euskadi','zip'=>'13237','country'=>'Aruba'),
        array('first'=>'Vance','last'=>'Burris','email'=>'mauris.ut@vitaemauris.net','street'=>'Ap #654-8839 Tristique Rd.','city'=>'Słupsk','state'=>'Pomorskie','zip'=>'15640','country'=>'Antigua and Barbuda'),
        array('first'=>'Reuben','last'=>'Cannon','email'=>'et.tristique.pellentesque@dapibusgravida.edu','street'=>'Ap #734-6684 Nunc Rd.','city'=>'Lublin','state'=>'LU','zip'=>'2692WV','country'=>'Italy'),
        array('first'=>'Jesse','last'=>'Roberts','email'=>'Duis.at.lacus@magnaNamligula.ca','street'=>'Ap #992-7207 Faucibus Av.','city'=>'Metairie','state'=>'Louisiana','zip'=>'3144','country'=>'Mauritania'),
        array('first'=>'Baker','last'=>'Gillespie','email'=>'pede.nonummy.ut@Cras.org','street'=>'3067 At, Road','city'=>'Blue Mountains','state'=>'NS','zip'=>'55919','country'=>'Western Sahara'),
        array('first'=>'Patrick','last'=>'Cleveland','email'=>'luctus.ut@perconubia.net','street'=>'Ap #736-5785 Augue Street','city'=>'Pratovecchio','state'=>'Toscana','zip'=>'S39 9XQ','country'=>'Seychelles'),
        array('first'=>'Marvin','last'=>'Everett','email'=>'ipsum@tellusnonmagna.org','street'=>'719-3272 Nibh. Ave','city'=>'Paisley','state'=>'Renfrewshire','zip'=>'7602','country'=>'Monaco'),
        array('first'=>'Neil','last'=>'Carr','email'=>'eu.accumsan.sed@a.co.uk','street'=>'2624 Lacus. Street','city'=>'Okene','state'=>'Kogi','zip'=>'4467WO','country'=>'Korea, South'),
        array('first'=>'Brent','last'=>'Salinas','email'=>'diam.luctus@facilisismagnatellus.edu','street'=>'869 Placerat, Rd.','city'=>'Buguma','state'=>'Rivers','zip'=>'51401','country'=>'French Guiana'),
        array('first'=>'Channing','last'=>'Mayo','email'=>'Donec@scelerisque.net','street'=>'360-6450 Lacus. Ave','city'=>'Bremerhaven','state'=>'Bremen','zip'=>'2150','country'=>'Cuba'),
        array('first'=>'Fitzgerald','last'=>'Estrada','email'=>'facilisis.eget@nonummyipsum.co.uk','street'=>'317-5979 Massa. St.','city'=>'Patalillo','state'=>'San José','zip'=>'00049','country'=>'Hong Kong'),
        array('first'=>'Kenyon','last'=>'Frost','email'=>'urna@aliquetodioEtiam.net','street'=>'P.O. Box 305, 4806 Id, Ave','city'=>'Gibsons','state'=>'British Columbia','zip'=>'9034','country'=>'Gabon'),
        array('first'=>'Dean','last'=>'Johnson','email'=>'eget.dictum@libero.co.uk','street'=>'P.O. Box 448, 4490 Quam. Avenue','city'=>'Tejar','state'=>'Cartago','zip'=>'2102','country'=>'United Kingdom (Great Britain)'),
        array('first'=>'Akeem','last'=>'Love','email'=>'non.leo@feugiatSednec.ca','street'=>'P.O. Box 472, 2233 Malesuada Av.','city'=>'Vienna','state'=>'Vienna','zip'=>'51511','country'=>'Indonesia'),
        array('first'=>'Cody','last'=>'Livingston','email'=>'non.lobortis.quis@euodioPhasellus.org','street'=>'9276 Vitae Ave','city'=>'St. Neots','state'=>'Huntingdonshire','zip'=>'3075','country'=>'Slovakia'),
        array('first'=>'Grant','last'=>'Santana','email'=>'pretium.et@Vestibulum.com','street'=>'4114 Cum Street','city'=>'Wollongong','state'=>'NS','zip'=>'1385','country'=>'Luxembourg'),
        array('first'=>'Eagan','last'=>'Lyons','email'=>'enim@Quisqueimperdiet.co.uk','street'=>'954-7822 Est Rd.','city'=>'New Westminster','state'=>'BC','zip'=>'71997','country'=>'South Sudan'),
        array('first'=>'Rashad','last'=>'Hayes','email'=>'in@varius.co.uk','street'=>'610-5145 Mi. Rd.','city'=>'Vienna','state'=>'Wi','zip'=>'70706','country'=>'United States'),
        array('first'=>'Colin','last'=>'Campos','email'=>'arcu.Vivamus@nequeetnunc.org','street'=>'Ap #625-9480 Diam. Rd.','city'=>'Oamaru','state'=>'SI','zip'=>'783527','country'=>'Pakistan'),
        array('first'=>'Jamal','last'=>'Mcfadden','email'=>'et.libero.Proin@diam.com','street'=>'1808 Cursus, Rd.','city'=>'Hattem','state'=>'Gl','zip'=>'8585SJ','country'=>'Belize'),
        array('first'=>'Jerry','last'=>'Sargent','email'=>'dui@egestasligula.org','street'=>'847-4962 Vestibulum Av.','city'=>'Belford Roxo','state'=>'Rio de Janeiro','zip'=>'76043','country'=>'Eritrea'),
        array('first'=>'Brenden','last'=>'Holden','email'=>'lacus.Aliquam@ametluctus.com','street'=>'2032 Rutrum Ave','city'=>'Matamata','state'=>'North Island','zip'=>'68896','country'=>'Iran'),
        array('first'=>'Elton','last'=>'Bean','email'=>'egestas.Duis.ac@orciinconsequat.org','street'=>'1797 Sit Street','city'=>'Vienna','state'=>'Vienna','zip'=>'89474','country'=>'Chad'),
        array('first'=>'Burton','last'=>'Drake','email'=>'mauris.erat@egetnisi.ca','street'=>'P.O. Box 824, 718 Lectus Street','city'=>'Nampa','state'=>'Idaho','zip'=>'82446-601','country'=>'Romania'),
        array('first'=>'Caldwell','last'=>'Hammond','email'=>'mi.lacinia@magnaSuspendisse.ca','street'=>'P.O. Box 330, 4668 Ipsum Av.','city'=>'Vigo','state'=>'GA','zip'=>'3447','country'=>'Virgin Islands, United States'),
        array('first'=>'Curran','last'=>'Knapp','email'=>'Praesent.eu.dui@Suspendissealiquet.com','street'=>'Ap #952-3766 Risus, Avenue','city'=>'Surat','state'=>'GJ','zip'=>'439701','country'=>'Belarus'),
        array('first'=>'Kasimir','last'=>'Terrell','email'=>'tincidunt.adipiscing.Mauris@Morbi.edu','street'=>'Ap #319-7469 Scelerisque, Road','city'=>'Beawar','state'=>'RJ','zip'=>'0678AD','country'=>'Bangladesh'),
        array('first'=>'Amos','last'=>'Alvarez','email'=>'rhoncus@faucibusorci.com','street'=>'P.O. Box 890, 2324 Fermentum Rd.','city'=>'Newcastle','state'=>'New South Wales','zip'=>'36911','country'=>'Micronesia'),
        array('first'=>'Daniel','last'=>'Cervantes','email'=>'et.ipsum.cursus@pedemalesuada.org','street'=>'141-9060 Ac St.','city'=>'Veere','state'=>'Zeeland','zip'=>'54-357','country'=>'Argentina'),
        array('first'=>'Ezekiel','last'=>'Simon','email'=>'sociis.natoque.penatibus@porttitorinterdumSed.edu','street'=>'Ap #114-6855 Nec, Street','city'=>'Curridabat','state'=>'SJ','zip'=>'11602','country'=>'South Georgia and The South Sandwich Islands')
    );

    private static $inventoryArray = array(
	array("name"=>"commodo","description"=>"pretium et, rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus in, hendrerit consectetuer, cursus et, magna. Praesent interdum ligula eu enim. Etiam imperdiet dictum magna. Ut tincidunt orci quis lectus.","price"=>"23.84","quantity"=>46),
	array("name"=>"neque. Nullam ut","description"=>"mattis velit justo nec ante. Maecenas mi felis, adipiscing fringilla, porttitor vulputate, posuere","price"=>"80.23","quantity"=>40),
	array("name"=>"ante dictum mi,","description"=>"eu, euismod ac, fermentum vel, mauris. Integer sem elit, pharetra ut, pharetra sed, hendrerit a, arcu. Sed et libero. Proin mi. Aliquam gravida mauris ut mi.","price"=>"0.79","quantity"=>36),
	array("name"=>"pretium aliquet,","description"=>"eu lacus. Quisque imperdiet, erat nonummy ultricies ornare, elit elit fermentum risus,","price"=>"58.25","quantity"=>42),
	array("name"=>"dui. Fusce","description"=>"neque vitae semper egestas, urna justo faucibus lectus, a sollicitudin orci sem eget massa. Suspendisse eleifend. Cras sed","price"=>"69.22","quantity"=>23),
	array("name"=>"Proin non massa non","description"=>"nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam","price"=>"68.39","quantity"=>45),
	array("name"=>"ligula.","description"=>"lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci, in consequat enim diam vel arcu. Curabitur ut odio vel est tempor bibendum. Donec felis orci,","price"=>"48.60","quantity"=>20),
	array("name"=>"lectus.","description"=>"eu metus. In lorem. Donec elementum, lorem ut aliquam iaculis, lacus pede sagittis augue, eu","price"=>"27.13","quantity"=>32),
	array("name"=>"neque.","description"=>"nec quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec","price"=>"92.13","quantity"=>20),
	array("name"=>"nulla magna, malesuada","description"=>"lorem, auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi.","price"=>"84.26","quantity"=>45),
	array("name"=>"velit egestas lacinia. Sed","description"=>"arcu. Vivamus sit amet risus. Donec egestas. Aliquam nec enim. Nunc ut erat. Sed nunc est, mollis non, cursus non, egestas a, dui. Cras pellentesque. Sed dictum. Proin eget","price"=>"88.20","quantity"=>22),
	array("name"=>"elementum purus,","description"=>"Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio.","price"=>"36.75","quantity"=>43),
	array("name"=>"Integer vulputate, risus a","description"=>"scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet orci. Ut sagittis lobortis mauris. Suspendisse aliquet molestie tellus. Aenean","price"=>"38.93","quantity"=>18),
	array("name"=>"dictum","description"=>"Aliquam fringilla cursus purus. Nullam scelerisque neque sed sem egestas blandit. Nam nulla magna, malesuada vel, convallis in, cursus et, eros. Proin ultrices. Duis volutpat nunc sit amet metus. Aliquam erat volutpat. Nulla facilisis.","price"=>"37.04","quantity"=>33),
	array("name"=>"in","description"=>"ut lacus. Nulla tincidunt, neque vitae semper egestas, urna justo faucibus lectus, a sollicitudin orci sem","price"=>"31.00","quantity"=>40),
	array("name"=>"ac, feugiat non, lobortis","description"=>"Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci, in consequat enim diam","price"=>"19.56","quantity"=>33),
	array("name"=>"facilisi. Sed neque. Sed","description"=>"Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius","price"=>"95.22","quantity"=>33),
	array("name"=>"commodo","description"=>"Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis non enim. Mauris quis turpis vitae purus gravida","price"=>"41.34","quantity"=>48),
	array("name"=>"varius ultrices, mauris","description"=>"luctus et ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis. Duis sit amet diam eu dolor egestas rhoncus. Proin nisl sem, consequat nec, mollis","price"=>"15.03","quantity"=>48),
	array("name"=>"fringilla, porttitor vulputate,","description"=>"lorem, auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus molestie dapibus ligula. Aliquam erat volutpat.","price"=>"76.73","quantity"=>50),
	array("name"=>"cursus.","description"=>"ultricies dignissim lacus. Aliquam rutrum lorem ac risus. Morbi metus. Vivamus euismod urna. Nullam lobortis quam a felis ullamcorper viverra. Maecenas iaculis aliquet diam. Sed diam lorem, auctor","price"=>"19.41","quantity"=>33),
	array("name"=>"dapibus rutrum,","description"=>"risus odio, auctor vitae, aliquet nec, imperdiet nec, leo. Morbi neque tellus, imperdiet non, vestibulum nec, euismod in, dolor. Fusce feugiat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aliquam auctor, velit eget","price"=>"74.68","quantity"=>16),
	array("name"=>"per inceptos","description"=>"dolor vitae dolor. Donec fringilla. Donec feugiat metus sit amet ante. Vivamus non lorem vitae odio","price"=>"80.44","quantity"=>48),
	array("name"=>"tellus. Phasellus","description"=>"In mi pede, nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus. Mauris non dui nec urna suscipit nonummy.","price"=>"3.04","quantity"=>50),
	array("name"=>"vitae, posuere at,","description"=>"Nunc mauris sapien, cursus in, hendrerit consectetuer, cursus et, magna. Praesent interdum ligula eu enim.","price"=>"73.29","quantity"=>27),
	array("name"=>"molestie","description"=>"sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan sed, facilisis vitae, orci. Phasellus dapibus quam quis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis","price"=>"90.14","quantity"=>15),
	array("name"=>"a,","description"=>"ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia","price"=>"18.13","quantity"=>40),
	array("name"=>"tincidunt","description"=>"sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat, eget tincidunt dui augue eu tellus. Phasellus elit pede, malesuada vel, venenatis vel, faucibus","price"=>"10.26","quantity"=>45),
	array("name"=>"nunc","description"=>"at risus. Nunc ac sem ut dolor dapibus gravida. Aliquam tincidunt, nunc ac mattis ornare, lectus ante dictum mi, ac mattis velit justo nec","price"=>"15.24","quantity"=>37),
	array("name"=>"enim non nisi. Aenean","description"=>"tincidunt vehicula risus. Nulla eget metus eu erat semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue","price"=>"73.53","quantity"=>21),
	array("name"=>"aliquet nec, imperdiet","description"=>"nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor at risus. Nunc ac sem ut dolor dapibus gravida. Aliquam tincidunt, nunc ac mattis ornare, lectus","price"=>"34.36","quantity"=>16),
	array("name"=>"ornare, facilisis eget,","description"=>"Phasellus fermentum convallis ligula. Donec luctus aliquet odio. Etiam ligula tortor, dictum eu, placerat eget, venenatis a, magna. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Etiam laoreet, libero et tristique pellentesque, tellus sem mollis dui,","price"=>"82.78","quantity"=>43),
	array("name"=>"orci. Ut","description"=>"libero. Proin mi. Aliquam gravida mauris ut mi. Duis risus odio, auctor vitae, aliquet nec, imperdiet nec, leo. Morbi neque tellus, imperdiet non, vestibulum nec,","price"=>"87.19","quantity"=>45),
	array("name"=>"dolor, tempus non, lacinia","description"=>"faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo. Proin","price"=>"16.20","quantity"=>44),
	array("name"=>"tempus non,","description"=>"non dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus ornare.","price"=>"6.28","quantity"=>16),
	array("name"=>"eu","description"=>"dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar arcu et pede. Nunc sed orci lobortis augue scelerisque mollis. Phasellus libero mauris, aliquam eu, accumsan","price"=>"93.68","quantity"=>29),
	array("name"=>"blandit. Nam nulla","description"=>"est ac facilisis facilisis, magna tellus faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo.","price"=>"58.75","quantity"=>31),
	array("name"=>"dapibus","description"=>"odio tristique pharetra. Quisque ac libero nec ligula consectetuer rhoncus. Nullam","price"=>"23.41","quantity"=>4),
	array("name"=>"magnis","description"=>"sem. Nulla interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing lobortis risus. In mi pede, nonummy ut, molestie","price"=>"33.28","quantity"=>30),
	array("name"=>"tempor bibendum. Donec","description"=>"rhoncus. Donec est. Nunc ullamcorper, velit in aliquet lobortis, nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt","price"=>"12.14","quantity"=>23),
	array("name"=>"tincidunt,","description"=>"neque vitae semper egestas, urna justo faucibus lectus, a sollicitudin orci sem eget massa. Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet","price"=>"80.52","quantity"=>28),
	array("name"=>"ultrices.","description"=>"mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu.","price"=>"61.30","quantity"=>35),
	array("name"=>"justo. Proin non","description"=>"tempus, lorem fringilla ornare placerat, orci lacus vestibulum lorem, sit amet ultricies sem magna nec quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec dignissim magna a tortor. Nunc commodo auctor velit.","price"=>"60.29","quantity"=>30),
	array("name"=>"Praesent","description"=>"sem molestie sodales. Mauris blandit enim consequat purus. Maecenas libero est, congue a, aliquet vel, vulputate","price"=>"48.31","quantity"=>39),
	array("name"=>"cursus","description"=>"Sed eget lacus. Mauris non dui nec urna suscipit nonummy. Fusce fermentum fermentum arcu. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus ornare. Fusce mollis. Duis sit amet diam eu dolor","price"=>"79.63","quantity"=>10),
	array("name"=>"ipsum. Donec","description"=>"massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus","price"=>"72.83","quantity"=>26),
	array("name"=>"sit amet, consectetuer adipiscing","description"=>"cursus non, egestas a, dui. Cras pellentesque. Sed dictum. Proin eget odio. Aliquam vulputate ullamcorper magna. Sed eu eros. Nam","price"=>"96.90","quantity"=>31),
	array("name"=>"nisi","description"=>"nunc, ullamcorper eu, euismod ac, fermentum vel, mauris. Integer sem elit, pharetra ut, pharetra sed, hendrerit a, arcu. Sed et libero. Proin mi. Aliquam gravida mauris ut mi. Duis risus odio, auctor vitae, aliquet","price"=>"53.66","quantity"=>13),
	array("name"=>"viverra. Donec","description"=>"velit. Aliquam nisl. Nulla eu neque pellentesque massa lobortis ultrices.","price"=>"44.21","quantity"=>29),
	array("name"=>"lobortis ultrices. Vivamus","description"=>"tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor","price"=>"34.59","quantity"=>20),
	array("name"=>"In mi pede, nonummy","description"=>"vulputate, nisi sem semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum","price"=>"6.84","quantity"=>18),
	array("name"=>"Morbi metus.","description"=>"lectus sit amet luctus vulputate, nisi sem semper erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare","price"=>"55.89","quantity"=>37),
	array("name"=>"eget ipsum.","description"=>"Quisque fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras dictum","price"=>"92.84","quantity"=>43),
	array("name"=>"Nullam vitae","description"=>"porttitor vulputate, posuere vulputate, lacus. Cras interdum. Nunc sollicitudin commodo ipsum. Suspendisse non leo. Vivamus nibh dolor, nonummy ac, feugiat","price"=>"30.47","quantity"=>39),
	array("name"=>"Cum sociis","description"=>"velit eu sem. Pellentesque ut ipsum ac mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta elit, a feugiat tellus lorem eu metus. In lorem. Donec elementum, lorem ut aliquam iaculis, lacus pede sagittis augue,","price"=>"12.61","quantity"=>39),
	array("name"=>"nibh dolor,","description"=>"vel arcu eu odio tristique pharetra. Quisque ac libero nec ligula consectetuer rhoncus. Nullam velit dui, semper et, lacinia vitae, sodales at, velit. Pellentesque ultricies dignissim","price"=>"0.33","quantity"=>12),
	array("name"=>"arcu iaculis enim,","description"=>"sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat. Sed nec metus facilisis lorem tristique","price"=>"90.53","quantity"=>43),
	array("name"=>"sociis natoque penatibus et","description"=>"metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies","price"=>"49.45","quantity"=>7),
	array("name"=>"enim,","description"=>"erat, in consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare tortor at risus. Nunc ac sem ut dolor dapibus gravida. Aliquam tincidunt, nunc ac mattis ornare, lectus","price"=>"81.78","quantity"=>42),
	array("name"=>"quis turpis vitae","description"=>"aliquet libero. Integer in magna. Phasellus dolor elit, pellentesque a, facilisis non, bibendum sed, est. Nunc laoreet lectus quis massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius orci, in consequat enim diam vel arcu. Curabitur ut","price"=>"18.53","quantity"=>10),
	array("name"=>"massa.","description"=>"tellus lorem eu metus. In lorem. Donec elementum, lorem ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat","price"=>"35.12","quantity"=>47),
	array("name"=>"neque","description"=>"Nam tempor diam dictum sapien. Aenean massa. Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis non enim. Mauris","price"=>"6.62","quantity"=>15),
	array("name"=>"dui. Fusce diam","description"=>"ac, feugiat non, lobortis quis, pede. Suspendisse dui. Fusce diam","price"=>"57.76","quantity"=>9),
	array("name"=>"erat","description"=>"id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo hendrerit. Donec porttitor tellus non magna. Nam ligula elit, pretium et, rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus in,","price"=>"69.65","quantity"=>8),
	array("name"=>"ac mattis","description"=>"Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet lorem semper auctor. Mauris vel turpis. Aliquam adipiscing lobortis risus.","price"=>"84.25","quantity"=>36),
	array("name"=>"Integer","description"=>"massa. Mauris vestibulum, neque sed dictum eleifend, nunc risus varius","price"=>"79.20","quantity"=>4),
	array("name"=>"Quisque nonummy","description"=>"ullamcorper, nisl arcu iaculis enim, sit amet ornare lectus justo eu arcu. Morbi sit amet massa. Quisque porttitor eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat","price"=>"65.05","quantity"=>27),
	array("name"=>"quis","description"=>"interdum. Curabitur dictum. Phasellus in felis. Nulla tempor augue ac ipsum. Phasellus vitae mauris sit amet lorem semper auctor. Mauris","price"=>"72.73","quantity"=>8),
	array("name"=>"dis","description"=>"Praesent luctus. Curabitur egestas nunc sed libero. Proin sed turpis nec mauris","price"=>"13.68","quantity"=>35),
	array("name"=>"orci. Phasellus dapibus","description"=>"sed libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi dictum augue malesuada malesuada. Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis","price"=>"45.16","quantity"=>46),
	array("name"=>"egestas hendrerit neque.","description"=>"ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat neque non quam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam fringilla cursus purus. Nullam scelerisque neque sed sem egestas blandit. Nam nulla","price"=>"68.47","quantity"=>7),
	array("name"=>"nunc.","description"=>"vel est tempor bibendum. Donec felis orci, adipiscing non, luctus","price"=>"31.75","quantity"=>12),
	array("name"=>"mus.","description"=>"vel turpis. Aliquam adipiscing lobortis risus. In mi pede, nonummy ut, molestie in, tempus eu, ligula. Aenean euismod mauris eu elit. Nulla facilisi. Sed neque. Sed eget lacus. Mauris non dui nec urna suscipit nonummy. Fusce fermentum fermentum","price"=>"3.94","quantity"=>22),
	array("name"=>"Morbi neque","description"=>"amet ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor diam dictum sapien. Aenean massa. Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo","price"=>"44.51","quantity"=>22),
	array("name"=>"nec, leo. Morbi","description"=>"Cras convallis convallis dolor. Quisque tincidunt pede ac urna. Ut tincidunt vehicula risus. Nulla eget metus eu erat semper","price"=>"25.03","quantity"=>29),
	array("name"=>"enim. Curabitur massa.","description"=>"nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis non enim. Mauris quis turpis vitae purus gravida sagittis. Duis gravida. Praesent eu nulla at sem molestie","price"=>"44.15","quantity"=>26),
	array("name"=>"pede nec ante","description"=>"Aenean gravida nunc sed pede. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel arcu eu odio tristique pharetra. Quisque ac","price"=>"98.16","quantity"=>24),
	array("name"=>"non","description"=>"neque et nunc. Quisque ornare tortor at risus. Nunc ac sem ut dolor dapibus gravida. Aliquam tincidunt, nunc ac mattis ornare, lectus","price"=>"93.63","quantity"=>6),
	array("name"=>"risus, at","description"=>"Morbi metus. Vivamus euismod urna. Nullam lobortis quam a felis ullamcorper viverra. Maecenas iaculis aliquet diam. Sed diam lorem, auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus molestie dapibus ligula. Aliquam erat volutpat.","price"=>"50.89","quantity"=>7),
	array("name"=>"dolor egestas rhoncus. Proin","description"=>"nulla. Integer urna. Vivamus molestie dapibus ligula. Aliquam erat volutpat. Nulla dignissim. Maecenas ornare egestas ligula. Nullam feugiat placerat velit. Quisque varius. Nam porttitor scelerisque neque. Nullam nisl. Maecenas malesuada fringilla est. Mauris eu turpis. Nulla aliquet.","price"=>"45.84","quantity"=>29),
	array("name"=>"amet metus. Aliquam erat","description"=>"elit, pretium et, rutrum non, hendrerit id, ante. Nunc mauris sapien, cursus in, hendrerit consectetuer, cursus et, magna. Praesent interdum ligula eu enim.","price"=>"12.89","quantity"=>35),
	array("name"=>"quam dignissim","description"=>"quis lectus. Nullam suscipit, est ac facilisis facilisis, magna tellus faucibus leo, in lobortis tellus justo sit amet nulla. Donec non justo. Proin non massa non ante bibendum ullamcorper. Duis cursus, diam at pretium aliquet, metus urna convallis erat,","price"=>"73.17","quantity"=>7),
	array("name"=>"sem ut","description"=>"Mauris ut quam vel sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus risus. Donec egestas. Duis ac arcu. Nunc mauris. Morbi non sapien molestie orci tincidunt adipiscing. Mauris molestie pharetra nibh. Aliquam ornare, libero at auctor ullamcorper, nisl","price"=>"15.98","quantity"=>33),
	array("name"=>"Proin mi.","description"=>"et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio. Nam interdum enim non nisi. Aenean eget metus. In","price"=>"68.28","quantity"=>39),
	array("name"=>"est. Nunc ullamcorper, velit","description"=>"consectetuer ipsum nunc id enim. Curabitur massa. Vestibulum accumsan neque et","price"=>"19.13","quantity"=>42),
	array("name"=>"dictum cursus. Nunc mauris","description"=>"nisi nibh lacinia orci, consectetuer euismod est arcu ac orci. Ut semper pretium neque. Morbi quis urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac","price"=>"39.07","quantity"=>13),
	array("name"=>"Vivamus","description"=>"urna. Nunc quis arcu vel quam dignissim pharetra. Nam ac nulla. In tincidunt congue turpis. In condimentum. Donec at arcu. Vestibulum ante ipsum primis in faucibus","price"=>"17.46","quantity"=>26),
	array("name"=>"dui, semper et,","description"=>"tristique pellentesque, tellus sem mollis dui, in sodales elit erat vitae risus. Duis a","price"=>"98.61","quantity"=>23),
	array("name"=>"tellus, imperdiet non,","description"=>"quis turpis vitae purus gravida sagittis. Duis gravida. Praesent eu nulla at sem molestie sodales. Mauris blandit enim consequat purus. Maecenas libero est, congue","price"=>"53.16","quantity"=>27),
	array("name"=>"ac","description"=>"sapien. Aenean massa. Integer vitae nibh. Donec est mauris, rhoncus id, mollis nec, cursus a, enim. Suspendisse aliquet, sem ut cursus luctus, ipsum leo elementum sem, vitae aliquam eros turpis non enim. Mauris quis turpis vitae purus","price"=>"96.17","quantity"=>29),
	array("name"=>"mi.","description"=>"cursus et, eros. Proin ultrices. Duis volutpat nunc sit amet metus. Aliquam erat volutpat. Nulla facilisis. Suspendisse commodo tincidunt nibh. Phasellus nulla. Integer vulputate, risus a ultricies adipiscing, enim mi tempor lorem, eget mollis lectus pede et risus.","price"=>"19.37","quantity"=>31),
	array("name"=>"Vestibulum ante ipsum primis","description"=>"mi eleifend egestas. Sed pharetra, felis eget varius ultrices, mauris ipsum porta elit, a feugiat tellus lorem eu metus. In lorem. Donec elementum, lorem ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat","price"=>"76.64","quantity"=>48),
	array("name"=>"non lorem","description"=>"Vivamus nibh dolor, nonummy ac, feugiat non, lobortis quis, pede. Suspendisse dui. Fusce diam nunc,","price"=>"22.10","quantity"=>48),
	array("name"=>"nisl","description"=>"ac metus vitae velit egestas lacinia. Sed congue, elit sed consequat auctor, nunc nulla vulputate dui, nec tempus mauris erat eget ipsum. Suspendisse sagittis. Nullam vitae diam. Proin dolor. Nulla semper tellus id nunc interdum feugiat.","price"=>"68.79","quantity"=>49),
	array("name"=>"sem elit, pharetra ut,","description"=>"eros nec tellus. Nunc lectus pede, ultrices a, auctor non, feugiat nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis eget, ipsum. Donec sollicitudin","price"=>"60.97","quantity"=>4),
	array("name"=>"sem ut dolor","description"=>"fringilla euismod enim. Etiam gravida molestie arcu. Sed eu nibh vulputate mauris sagittis placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante, iaculis nec, eleifend non, dapibus","price"=>"14.10","quantity"=>34),
	array("name"=>"Quisque purus sapien,","description"=>"quam quis diam. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce aliquet magna a neque. Nullam ut nisi a odio semper","price"=>"73.27","quantity"=>20),
	array("name"=>"ut,","description"=>"iaculis aliquet diam. Sed diam lorem, auctor quis, tristique ac, eleifend vitae, erat. Vivamus nisi. Mauris nulla. Integer urna. Vivamus molestie dapibus ligula. Aliquam erat volutpat. Nulla dignissim. Maecenas ornare egestas ligula.","price"=>"54.97","quantity"=>29),
	array("name"=>"Vivamus nisi. Mauris","description"=>"Donec sollicitudin adipiscing ligula. Aenean gravida nunc sed pede. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin vel arcu eu odio tristique pharetra. Quisque ac libero nec ligula consectetuer","price"=>"99.92","quantity"=>47),
	array("name"=>"Nullam velit dui, semper","description"=>"nonummy ac, feugiat non, lobortis quis, pede. Suspendisse dui. Fusce diam nunc, ullamcorper eu, euismod ac, fermentum vel, mauris. Integer sem elit, pharetra ut, pharetra sed, hendrerit a, arcu. Sed et libero. Proin","price"=>"30.24","quantity"=>22)
);

    private $container = NULL;

    /**
     * @var Doctrine\ORM\EntityManager
     */
    private $em = NULL;

    public function up(Schema $schema)
    {
        $this->loadBaseCustomers();
        $this->loadBaseInventory();
    }

    public function down(Schema $schema)
    {
        $customers = $this->em->getRepository('Group3\Bundle\ABundle\Entity\Customer')->findAll();
        foreach($customers as $customer)
        {
            $this->em->remove($customer);
        }

        $inventory = $this->em->getRepository('Group3\Bundle\ABundle\Entity\Inventory')->findAll();
        foreach($inventory as $item)
        {
            $this->em->remove($item);
        }
        $this->em->flush();
    }

    public function setContainer(ContainerInterface $container = NULL)
    {
        $this->container = $container;
        // Get the entity manager so we can easily create some files
        $this->em = $container->get("doctrine.orm.entity_manager");
    }

    private function loadBaseCustomers()
    {
        foreach(self::$customersArray as $customerArray)
        {
            $customer = new Customer();
            $customer->setFirstName($customerArray['first']);
            $customer->setLastName($customerArray['last']);
            $customer->setEmailAddress($customerArray['email']);
            $customer->setStreet($customerArray['street']);
            $customer->setCity($customerArray['city']);
            $customer->setState($customerArray['state']);
            $customer->setCountry($customerArray['country']);
            $customer->setZip($customerArray['zip']);
            $this->em->persist($customer);
        }
        $this->em->flush();
    }

    private function loadBaseInventory()
    {
        foreach(self::$inventoryArray as $inventoryArray)
        {
            $item = new Inventory();
            $item->setItemDescription($inventoryArray['description']);
            $item->setItemName($inventoryArray['name']);
            $item->setPrice($inventoryArray['price']);
            $item->setQuantityInStock($inventoryArray['quantity']);
            $this->em->persist($item);
        }

        $this->em->flush();
    }
}
