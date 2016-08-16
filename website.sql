--
-- Database: `website`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `username` text COLLATE utf8_polish_ci NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `username`, `login`, `password`) VALUES
(1, 'Mister', 'MisterCodePL', '$2y$10$jSGbTsSfDxpeepmMTMJti.3j0vQDzEf2BHb8/k1A1y.cm/ylEiIpC');

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `authorId` int(11) NOT NULL,
  `createDate` datetime NOT NULL,
  `category` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `friendlyAddress` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `name`, `authorId`, `createDate`, `category`, `content`, `friendlyAddress`) VALUES
(5, 'ArtykuÅ‚', 1, '2016-08-14 00:00:00', 'Karta dÅºwiÄ™kowa', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas consequat viverra lacus finibus placerat. Nulla tincidunt arcu a libero sagittis maximus. Proin a lectus libero. Morbi in sapien ante. Proin ex eros, lacinia quis libero eget, ultrices varius odio. Maecenas id condimentum nibh. Vivamus molestie dolor et blandit hendrerit. Etiam elementum dapibus nulla, sit amet maximus ante vulputate tincidunt. Suspendisse condimentum malesuada lorem, ac pellentesque sapien cursus et. Nulla vulputate at odio sodales consequat. Sed imperdiet eros sed mauris tristique pharetra. Vivamus non turpis ante. \r\n<br /><br />\r\nEtiam interdum nibh eu massa congue, at lacinia ante tincidunt. Proin elementum sollicitudin dapibus. Duis gravida nisi vehicula ligula tincidunt, a luctus risus dictum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce nulla odio, sodales in fermentum eget, elementum non justo. Nulla facilisi. Etiam at tristique massa. Praesent sed ex odio. \r\n<br /><br />\r\nAenean ullamcorper mauris metus, nec consequat lectus consectetur in. Vestibulum sit amet quam ac nulla sodales mattis vel vitae ligula. Pellentesque quis pharetra est, id ullamcorper massa. Suspendisse in rutrum leo. Pellentesque et eleifend ante. Donec eu lacus placerat, egestas augue eu, pulvinar quam. Nulla consectetur lectus in semper malesuada. Maecenas consectetur accumsan diam non cursus. \r\n<br /><br />\r\nAenean in ante elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque viverra feugiat sem, ac luctus leo porta nec. Nulla non ornare mi, eget tincidunt augue. Nullam lacinia blandit elit, at suscipit sapien lobortis vehicula. Etiam ut finibus neque. Praesent mattis, arcu ut porta aliquam, turpis libero ultricies dui, in accumsan ligula nulla nec est. Nam eu nisl id neque maximus aliquet sit amet in nunc. Suspendisse potenti. In nec justo et lorem semper ullamcorper vitae in dui. Vestibulum turpis enim, ultricies sed elementum et, scelerisque eget orci. Nullam at elit eget orci vestibulum sodales et eget tellus. \r\n<br /><br />\r\nPraesent lacinia quam a leo fermentum lacinia. Integer sit amet efficitur neque, quis condimentum sem. Pellentesque quis tortor erat. Praesent condimentum quis neque lobortis tincidunt. Nullam et euismod mauris. Pellentesque nec consequat ex. Maecenas eget porttitor sem. Aliquam a diam ut diam pretium placerat vitae et libero. Mauris id purus vel dolor convallis porttitor gravida et neque. \r\n<br /><br />\r\nUt vel orci sagittis, sollicitudin neque eget, vulputate leo. Nullam dapibus finibus ornare. Morbi egestas arcu enim, elementum lacinia leo iaculis vitae. Suspendisse rhoncus tempor eros, quis ornare quam pulvinar sed. Proin sit amet est eu massa elementum dapibus. Phasellus et ante fermentum, scelerisque magna auctor, tempor purus. Maecenas ex felis, iaculis ut vestibulum sed, rutrum et ligula. Sed et quam quis ipsum porttitor pharetra. Vivamus faucibus scelerisque tellus, vel ullamcorper odio tristique vel. Nam aliquet felis lectus, quis varius nisl porta sed. Praesent accumsan erat a odio iaculis, ac sodales purus volutpat. In nec semper elit. \r\n<br /><br />\r\nCurabitur id ultricies nunc. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc turpis dolor, dapibus sit amet erat non, lacinia venenatis turpis. Sed non nulla at sapien accumsan aliquam sit amet id enim. Aenean quis sem tempor, vehicula velit quis, porta urna. Quisque mollis mollis velit vel aliquet. Aliquam pretium lectus ac massa malesuada tincidunt. Phasellus neque ex, sollicitudin id elit nec, lobortis ornare nulla. Suspendisse dui tortor, sagittis sed molestie id, vulputate sit amet velit. \r\n<br /><br />\r\nPraesent ut blandit ipsum. Mauris feugiat sit amet tellus et venenatis. In tincidunt dui posuere sodales ornare. Nullam et lorem a sem consequat molestie. Sed sed quam eget felis tempor sollicitudin eu et leo. Pellentesque lectus nisl, rutrum ac enim sed, porttitor interdum nulla. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris lacus diam, luctus id lacinia sed, bibendum laoreet sem. Sed at porta nisl, quis hendrerit mi. Sed quis iaculis dui. \r\n<br /><br />\r\nSed non sapien non nulla elementum malesuada. Mauris tincidunt pellentesque massa, id condimentum dui tempor at. Donec pellentesque vehicula turpis, rutrum tristique nisl. Praesent consectetur turpis vel nibh consequat, a sagittis leo sodales. Donec at tortor eget diam sodales tristique at eu sapien. Aliquam eu dolor nisi. Donec porta quis tortor sit amet venenatis. Aliquam mi augue, ornare molestie purus et, facilisis mollis nisl. \r\n<br /><br />\r\nNunc placerat, lectus sed aliquet eleifend, dui erat rhoncus arcu, eget tempor elit quam in dui. Ut id feugiat nibh. Suspendisse lacus velit, fermentum et vestibulum id, porttitor sed ex. Nam bibendum venenatis enim sit amet lobortis. Integer et sem mauris. In pharetra dolor blandit, pellentesque turpis nec, blandit purus. Mauris tincidunt sed turpis et congue. Phasellus consequat eleifend metus, ut aliquet ante tincidunt ut. Praesent scelerisque nibh orci, in maximus leo vehicula at. Aenean convallis tempus ex at lacinia. Etiam pretium, dolor a auctor ultrices, sapien augue lacinia risus, id tempus leo libero a tortor. Nullam lacus libero, congue et dolor at, varius malesuada mauris. Sed ullamcorper facilisis tortor a lacinia. Duis tempor libero in velit sollicitudin ultricies. Cras laoreet augue a sagittis accumsan. \r\n<br /><br />\r\nPhasellus eleifend, velit at venenatis semper, velit arcu facilisis dui, vel elementum ante lorem in sem. Phasellus magna ex, dictum ac tempor id, interdum ut enim. Aenean ut maximus odio. Vestibulum placerat mauris sed ex dictum auctor. Phasellus iaculis sapien vel augue lacinia, et efficitur purus sagittis. Donec porta magna mauris, id euismod est semper nec. Quisque sit amet imperdiet nisl. \r\n<br /><br />\r\nPhasellus egestas ultricies placerat. Duis aliquet volutpat ipsum, et pretium ipsum feugiat id. Aenean id orci tellus. Mauris hendrerit libero sed consectetur gravida. Mauris eget leo sed augue tristique tincidunt. Integer pretium tortor quis porttitor laoreet. Fusce vel arcu eros. Aenean a lacus vel sem scelerisque cursus eget vel neque. Ut non bibendum lorem. Curabitur vel nibh nulla. Donec convallis eu purus vitae ultrices. \r\n<br /><br />\r\nDonec venenatis dictum orci, eget suscipit massa ornare sed. Cras sem turpis, gravida non luctus ut, rhoncus at lorem. In in interdum magna. Donec sed pulvinar nulla. Aliquam vitae fringilla mi. Curabitur sit amet hendrerit urna. Aenean commodo faucibus metus at viverra. Maecenas id nibh id elit viverra sollicitudin. Praesent auctor diam nunc, nec finibus quam vehicula quis. Donec rhoncus sagittis est, eu consequat orci aliquet at. Sed rhoncus sapien at nibh rhoncus facilisis. Quisque scelerisque, elit eu varius malesuada, quam magna porta enim, eget maximus felis leo a lorem. \r\n<br /><br />\r\nNullam ornare sem at metus condimentum, sit amet feugiat arcu viverra. Aliquam at massa lacinia, accumsan velit ut, imperdiet nisi. Curabitur fringilla lacinia ex. Vestibulum at fermentum tellus. Sed neque elit, suscipit semper lacinia non, finibus ut leo. Etiam at fermentum nulla. Quisque ut lacinia nisi. Maecenas arcu leo, ultricies in diam at, pulvinar tempus nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. \r\n<br /><br />\r\nNam pellentesque justo fermentum ex iaculis semper. Nam vitae lacus elementum, rhoncus nulla vitae, convallis nibh. Sed hendrerit eget nisi nec venenatis. In a ipsum tortor. Nam quis augue lacus. Ut accumsan nibh lectus, eget facilisis lectus tristique vel. Donec et neque eget massa consectetur euismod. Donec rutrum metus tortor, at ultrices dui convallis sit amet. Nullam rutrum congue ante, congue rhoncus purus egestas non. Sed dapibus enim ut auctor interdum. \r\n<br /><br />\r\nEtiam ac turpis vulputate, mollis lectus sit amet, elementum tortor. Etiam facilisis sem magna, et lobortis ex viverra sit amet. Sed laoreet ultrices dolor id condimentum. Quisque sed vehicula sapien. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus interdum, magna eget laoreet accumsan, ligula ex vestibulum sem, at convallis mi mi in erat. Cras lacinia nulla nisi, in dictum leo ullamcorper ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent elit orci, pretium quis diam sed, pretium dignissim nisi. Cras quis eros id dolor finibus pulvinar eu tincidunt lectus. Ut tempor turpis justo, a malesuada tellus malesuada vitae. Maecenas lectus metus, aliquet sit amet massa id, vulputate commodo mi. Sed ac fringilla tortor, a ultricies sapien. \r\n<br /><br />\r\nNulla dictum, metus at pharetra pretium, justo lacus vestibulum felis, vel cursus lacus magna eget libero. Praesent ornare ultrices sapien, vel scelerisque augue tempor sit amet. Mauris eget mi laoreet, pellentesque metus non, pharetra ligula. Morbi sit amet turpis et felis viverra mattis vel et tortor. Sed quis accumsan erat. Proin cursus volutpat nulla, vitae imperdiet tellus rhoncus a. Integer pulvinar velit id est sollicitudin finibus. Praesent ac tristique elit. \r\n<br /><br />\r\nCras at turpis consequat, venenatis elit sit amet, fermentum enim. Praesent nec tincidunt quam, in accumsan enim. Fusce non massa in neque condimentum commodo a at metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce at viverra libero, et mollis orci. Nulla a urna in est viverra imperdiet. Praesent elementum efficitur scelerisque. Aliquam erat volutpat. Maecenas hendrerit ex tortor. Donec nisl orci, bibendum quis porta eget, suscipit fermentum ex. Aliquam vitae lacus et nibh dapibus euismod egestas non ex. Integer tincidunt sem ac venenatis tristique. Fusce sed vestibulum velit. Praesent sed urna non purus tempor dictum. \r\nDonec eget lacus porta, rhoncus neque at, molestie nunc. Sed enim ex, rhoncus sit amet nisl vel, convallis ultrices leo. Nulla facilisi. Aenean et dapibus ipsum. Ut fringilla lectus sed odio iaculis, vitae iaculis odio tincidunt. In quam sem, ultricies eu urna vestibulum, suscipit molestie lorem. Fusce posuere leo nec libero interdum pulvinar. Donec rutrum dui vitae eros sodales, ac fringilla massa tincidunt. Morbi in erat nec ipsum hendrerit vestibulum a at diam. Donec blandit elit urna, non porta enim pulvinar a. Vivamus rutrum, mauris a sodales volutpat, massa quam porta nulla, et mollis tellus enim et nulla. Proin ultricies ornare porttitor. Ut lacinia ullamcorper tellus quis finibus. Cras justo nisl, condimentum ut consequat quis, imperdiet a lacus.\r\n<br /><br /> \r\nMaecenas eleifend consequat eros. Nunc sem tellus, volutpat eu dignissim in, convallis sit amet ligula. Fusce non ligula vitae erat posuere tristique. Maecenas sed lectus nec ante malesuada congue eu quis orci. Maecenas sed turpis molestie, faucibus erat tincidunt, blandit lacus. Aliquam velit massa, rutrum eu facilisis nec, fermentum non diam. Proin a dui quis ipsum congue convallis. Nullam tincidunt euismod fermentum. Fusce efficitur tincidunt neque, accumsan pharetra enim tempor a. Fusce a auctor odio. Quisque dolor mauris, feugiat eu mollis sed, aliquam non quam. Sed elementum nisl id ipsum aliquam scelerisque. Aenean a dignissim mauris, in pharetra ipsum. Aliquam placerat nec dolor at porttitor. Proin felis lacus, dictum in auctor id, auctor eu quam. Curabitur consequat vitae urna a pellentesque. \r\n<br /><br />', 'sprzet/karta-dzwiekowa/artykul'),
(6, 'ArtykuÅ‚', 1, '2016-08-16 11:11:10', 'O nas', 'Litwo! Ojczyzno maja! Ty jesteÅ› jak zdrowie, <br/>\r\nIle ciÄ™ trzeba ceniÄ‡, ten tylko siÄ™ dowie, <br/>\r\nKto ciÄ™ straciÅ‚. DziÅ› piÄ™knoÅ›Ä‡ twÄ… w caÅ‚ej ozdobie <br/>\r\nWidzÄ™ i opisujÄ™, bo tÄ™skniÄ™ po tobie" <br/>\r\nPanno Å›wiÄ™ta, co Jasnej bronisz CzÄ™stochowy <br/>\r\nI w Ostrej Å›wiecisz Bramie! Ty, co grÃ³d zamkowy <br/>\r\nNowogrÃ³dzki ochraniasz z jego wiernym ludem! <br/>\r\nJak mnie dziecko do zdrowia powrÃ³ciÅ‚aÅ› cudem, <br/>\r\n(Gdy od pÅ‚aczÄ…cej matki pod TwojÄ… opiekÄ™ <br/>\r\nOfiarowany, martwÄ… podniosÅ‚em powiekÄ™ <br/>\r\nI zaraz mogÅ‚em pieszo do Twych Å›wiÄ…tyÅ„ progu <br/>\r\nIÅ›Ä‡ za wrÃ³cone Å¼ycie podziÄ™kowaÄ‡ Bogu), <br/>\r\nTak nas powrÃ³cisz cudem na Ojczyzny Å‚ono. <br/>\r\nTymczasem przenoÅ› mojÄ… duszÄ™ utÄ™sknionÄ… <br/>\r\nDo tych pagÃ³rkÃ³w leÅ›nych, do tych Å‚Ä…k zielonych, <br/>\r\nSzeroko nad bÅ‚Ä™kitnym Niemnem rozciÄ…gnionych; <br/>\r\nDo tych pÃ³l malowanych zboÅ¼em rozmaitem, <br/>\r\nWyzÅ‚acanych pszenicÄ…, posrebrzanych Å¼ytem; <br/>\r\nGdzie bursztynowy Å›wierzop, gryka jak Å›nieg biaÅ‚a, <br/>\r\nGdzie panieÅ„skim rumieÅ„cem dziÄ™cielina paÅ‚a, <br/>\r\nA wszystko przepasane jakby wstÄ™gÄ…, miedzÄ… <br/>\r\nZielonÄ…, na niej z rzadka ciche grusze siedzÄ….<br/>', 'o-nas/o-nas/artykul'),
(7, 'Tren', 1, '2016-08-16 11:10:19', 'O nas', 'WielkieÅ› mi uczyniÅ‚a pustki w domu moim, <br />\r\nMoja droga Orszulo, tym zniknieniem swoim! <br />\r\nPeÅ‚no nas, a jakoby nikogo nie byÅ‚o:<br />\r\nJednÄ… maluczkÄ… duszÄ… tak wiele ubyÅ‚o.<br />\r\nTyÅ› za wszytki mÃ³wiÅ‚a, za wszytki Å›piewaÅ‚a, <br />\r\nWszytkiÅ› w domu kÄ…ciki zawÅ¼dy pobiegaÅ‚a. <br />\r\nNie dopuÅ›ciÅ‚aÅ› nigdy matce siÄ™ frasowaÄ‡ <br />\r\nAni ojcu myÅ›leniem zbytnim gÅ‚owy psowaÄ‡, <br />\r\nTo tego, to owego wdziÄ™cznie obÅ‚apiajÄ…c<br />\r\nI onym swym uciesznym Å›miechem zabawiajÄ…c. <br />\r\nTeraz wszytko umilkÅ‚o, szczere pustki w domu, <br />\r\nNie masz zabawki, nie masz rozÅ›miaÄ‡ siÄ™ nikomu. <br />\r\nZ kaÅ¼dego kÄ…ta Å¼aÅ‚oÅ›Ä‡ czÅ‚owieka ujmuje,<br />\r\nA serce swej pociechy darmo upatruje.<br />', 'o-nas/o-nas/tren'),
(8, 'fdsfdsfdsf', 1, '2016-08-16 11:13:00', 'PÅ‚yta gÅ‚Ã³wna', 'sdfdsfsfsfsfsdf', 'sprzet/plyta-glowna/fdsfdsfdsf');

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `path` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `size` int(11) NOT NULL,
  `authorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `name`, `path`, `size`, `authorId`) VALUES
(1, 's0.jpg', '/Website/files/s0.jpg', 9, 1),
(2, 's1.jpg', '/Website/files/s1.jpg', 11, 1),
(3, 's2.jpg', '/Website/files/s2.jpg', 15, 1),
(4, 's3.jpg', '/Website/files/s3.jpg', 20, 1),
(5, 's4.jpg', '/Website/files/s4.jpg', 21, 1),
(6, 's5.jpg', '/Website/files/s5.jpg', 24, 1),
(7, 'logo.png', '/Website/files/logo.png', 534, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
