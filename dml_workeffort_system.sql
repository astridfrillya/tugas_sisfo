===========================DML=======================

insert into req_type values(
'5',
'production run');

insert into req_type values(
'6',
'internal project');


insert into req_type values(
'7',
'maintenance');

 insert into work_req values(
 '50985',
 '5',
 '5 juli 2000',
 '5 agustus 2000',
 'anticipated demand of 2000 custom-engraved');

  insert into work_req values(
 '51245',
 '5',
 '5 september 2000',
 '5 november 2000',
 'anticipated demand of 1500 custom-engraved');
 
  insert into work_req values(
 '51285',
 '5',
 '8 november 2000',
 '5 desember 2000',
 'anticipated demand of 3000 custom-engraved');
 
 insert into work_req values(
 '60102',
 '6',
 '15 oktober 2000',
 '15 desember 2000',
 'develop sales and marketing plan 2002');

 insert into work_req values(
 '70485',
 '7',
 '16 juni 2000',
 '18 juni 2000',
 'fix engraving machine');
 
 
 
insert into work_req_type values(
'01',
'50985',
'Anticipated demand Engraved 2000',
'engraved black-pen with gold trim',
2000,
'-');

insert into work_req_type values(
'02',
'51245',
'Anticipated demand Engraved 1500',
'engraved black-pen with gold trim',
1500,
'-');

insert into work_req_type values(
'03',
'51285',
'Anticipated demand Engraved 3000',
'engraved black-pen with gold trim',
3000,
'-');

insert into work_req_type values(
'04',
'60102',
'Develop sales and marketing plan for 2001',
'-',
'',
'2001 Sales/Marketing Plan');

insert into work_req_type values(
'05',
'70485',
'fix engraving machine',
'-',
'',
'-');

 insert into req_role_type values(
 'rrt01',
 'created for');
 
 insert into req_role_type values(
 'rrt02',
 'created by');
 
  insert into req_role_type values(
 'rrt03',
 'responsible for');
 
  insert into req_role_type values(
 'rrt04',
 'authorized by');
 
insert into party values(
'p01',
'ABC Manufacturing');

insert into party values(
'p02',
'John Smith');

insert into party values(
'p03',
'Sam Bossman');

insert into party values(
'p04',
'Dick Jones');

insert into party_work_req_role values(
'pwrr01',
'50985',
'rrt01',
'p01',
'5 juli 2000',
' ');

insert into party_work_req_role values(
'pwrr02',
'50985',
'rrt02',
'p02',
'5 juli 2000',
' ');

insert into party_work_req_role values(
'pwrr03',
'50985',
'rrt03',
'p02',
'5 juli 2000',
'15 desember 2000');

insert into party_work_req_role values(
'pwrr04',
'50985',
'rrt04',
'p03',
'8 juli 2000',
' ');

insert into party_work_req_role values(
'pwrr05',
'50985',
'rrt03',
'p04',
'16 desember 2000',
'20 februari 2001');

insert into party_work_req_role values(
'pwrr06',
'50985',
'rrt03',
'p02',
'21 februari 2001',
' ');

insert into party_work_req_role values(
'pwrr07',
'60102',
'rrt01',
'p03',
'10 juni 2000',
' ');

insert into party_work_req_role values(
'pwrr08',
'60102',
'rrt03',
'p04',
'15 juni 2000',
'1 januari 2001');

 insert into we_type values(
 'type1',
 'job',
 '');

 insert into we_type values(
 'type2',
 'activity',
 '20');
 
 insert into we_type values(
 'type3',
 'activity',
 '10');
 
 insert into we_type values(
 'type4',
 'activity',
 '5');
 
 insert into we_type values(
 'type5',
 'task',
 '5');
 
 insert into we_type values(
 'type6',
 'task',
 '8'); 
 
 insert into we_type values(
 'type7',
 'task',
 '7');
 
insert into work_effort values(
'28045',
'type1',
'production run',
'prod run of 3500 pencils',
'1 juni 2000',
'4 juni 2000',
'');

insert into work_effort values(
'51285',
'type1',
'production run',
'prod run of 1500 pencils',
'5 desember 2000',
'4 januari 2000',
'');

insert into work_effort values(
'51298',
'type1',
'production run',
'prod run of 1500 pencils',
'6 desember 2000',
'1 februari 2001',
'');

insert into work_effort values(
'29534',
'type1',
'production run #1',
'prod run of 1500 pencils',
'23 februari 2001',
'4 juni 2001',
'');

insert into work_effort values(
'29874',
'type1',
'production run #2',
'prod run of 1000 pencils',
'23 maret 2001',
'4 juni 2001',
'');

insert into work_effort values(
'12001',
'type2',
'set up production line',
'',
'1 juni 2001',
'4 juni 2001',
'20');

insert into work_effort values(
'3454587',
'type6',
'move pen manufactur in place',
'',
'1 juni 2000',
'1 juni 2001',
'7');

insert into we_from_work_req values(
'wfwr01',
'28045',
'50985');

insert into we_from_work_req values(
'wfwr02',
'28045',
'51245');

insert into we_from_work_req values(
'wfwr03',
'51285',
'51285');

insert into we_from_work_req values(
'wfwr04',
'51298',
'');

insert into order_item values(
'oi01',
'2 oktober 2000',
2000,
100000);

insert into order_item values(
'oi02',
'2 oktober 2000',
2500,
100000);

insert into we_from_order_item values(
'wfoi01',
'29534',
'oi02',
'customized');

insert into we_from_order_item values(
'wfoi02',
'29874',
'oi02',
'customized');

insert into we_breakdown values(
'webd01',
'28045',
'type1',
'wfwr01',
'');