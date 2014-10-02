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
