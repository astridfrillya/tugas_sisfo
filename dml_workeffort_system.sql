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

insert into party values(
'p05',
'Bob Jenkins');

insert into party values(
'p06',
'Jane Smith');

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
'12000',
'type2',
'set up production line',
'',
'1 juni 2001',
'4 juni 2001',
'20');

insert into work_effort values(
'34545',
'type6',
'move pen manufactur in place',
'',
'1 juni 2000',
'1 juni 2001',
'7');

insert into work_effort values(
'39409',
'type4',
'develop a sales and marketing',
'',
'2 januari 2001',
'15 september 2001',
'');

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
'1',
'120001',
'12000');

insert into we_breakdown values(
'2',
'120001',
'28045');

insert into we_breakdown values(
'4',
'120002',
'28045');

insert into we_party_assignment_data values(
'wepad01',
'39409',
'p04',
'project manager',
'2 januari 2001',
'15 september 2001',
'');

insert into we_party_assignment_data values(
'wepad02',
'39409',
'p05',
'project administrator',
'',
'',
'');

insert into we_party_assignment_data values(
'wepad03',
'39409',
'p02',
'team member',
'5 maret 2001',
'6 agustus 2001',
'leaving vacation on 7 agustus, 2001');

insert into we_party_assignment_data values(
'wepad04',
'39409',
'p02',
'team member',
'1 september 2001',
'2 desember 2001',
'');

insert into we_party_assignment_data values(
'wepad05',
'39409',
'p06',
'team member',
'6 agustus 2001',
'15 september 2001',
'very excited about assignment');

insert into party_skill_data values(
'001',
'p01',
'market research',
'30',
'9');

insert into party_skill_data values(
'002','p02',
'project management',
'20',
'10');

insert into party_skill_data values(
'003','p02',
'marketing',
'5',
'6');

insert into party_skill_data values(
'004','p04',
'project management',
'12',
'8');

insert into we_status values(
's1',
'1',
'started 2jun2000 1pm, complete 2jun2000 2pm');

insert into we_status values(
's2',
'4',
'started 3jun2000 1pm, complete 3jun2000 4pm');

insert into time_sheet_entry values(
'1390',
'1 jan 2001',
'15 jan 2001',
'p02',
'29000',
'2 jan 2001',
'4 jan 2001',
13);

insert into work_effort values(
'29000',
'type3',
'develop project plan',
'',
'',
'',
'6');

insert into rare_type values(
'r3',
'regular billing');

insert into rare_type values(
'r2',
'overtime billing');

insert into rare_type values(
'r1',
'regular pay');

insert into rare_type values(
'r4',
'overtime pay');

insert into we_rate values(
'werate1',
'develop accounting program',
'p07',
'r3',
'15may2000',
'14may2001',
65);

insert into fixed_asset_type values(
'1390',
'pm machine',
'equipment');

insert into fixed_asset_type values(
'2266',
'fork lift',
'vehicle');

insert into fixed_asset_type values(
'1000',
'pm machine',
'equipment');

insert into fixed_asset values(
'fa1',
'1000',
'pencil labeller #1',
'12 juni 2000',
'12 juni 2000',
'12 juni 2001',
1000000,
'pens/day');
