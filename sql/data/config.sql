--
-- Dumping data for table `config`
--

INSERT INTO `config` ( configName, configValue, displayName, showOnPanel, createdDate, modifiedDate ) VALUES
( 'showTapNumCol', '1', 'Tap Column', '1', NOW(), NOW() ),
( 'showSrmCol', '1', 'SRM Column', '1', NOW(), NOW() ),
( 'showIbuCol', '1', 'IBU Column', '1', NOW(), NOW() ),
( 'showAbvCol', '1', 'ABV Column', '1', NOW(), NOW() ),
( 'showAbvImg', '1', 'ABV Images', '1', NOW(), NOW() ),
( 'showKegCol', '0', 'Keg Column (beta!)', '1', NOW(), NOW() ),
( 'useHighResolution', '0', '4k Monitor Support', '1', NOW(), NOW() ),
( 'showRPLogo', '0', 'Show the RaspberryPints Logo', '1', NOW(), NOW() ),
( 'showCalories', '0', 'Show the calories', '1', NOW(), NOW() ),
( 'showGravity', '0', 'Show the Gravity numbers', '1', NOW(), NOW() ),
( 'showBalance', '0', 'Show the Balance', '1', NOW(), NOW() ),
( 'logoUrl', 'data/images/logo.png', 'Logo Url', '0', NOW(), NOW() ),
( 'adminLogoUrl', 'data/images/adminlogo.png', 'Admin Logo Url', '0', NOW(), NOW() ),
( 'headerText', 'Currently On Tap', 'Header Text', '0', NOW(), NOW() ),
( 'numberOfTaps', '0', 'Number of Taps', '0', NOW(), NOW() ),
( 'version', '1.0.0.369', 'Version', '0', NOW(), NOW() ),
( 'headerTextTruncLen' ,'20', 'Header Text Truncate Length', '0', NOW(), NOW() ),
( 'showBreweryImages', '0', 'Show Brewery Images', '1', NOW(), NOW() );