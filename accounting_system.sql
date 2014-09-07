===========DDL==============

===GL TYPE===

create table gl_type(
gl_type_id char(2),
gl_type_desc varchar(20),
constraint pk_gl_type PRIMARY KEY(gl_type_id));

===GL====

create table gl(
acc_id char(5),
gl_desc varchar2(30),
constraint pk_gl PRIMARY KEY(acc_id));

===ORG GL===

create table org_gl(
org_gl_id char(5),
org_gl_amount int,
acc_id char(5),
constraint pk_org_gl PRIMARY KEY(org_gl_id),
constraint fk_org_gl FOREIGN KEY(acc_id) REFERENCES gl);

===TRX====

create table trx(
trx_id char(2),
trx_date varchar2(20),
trx_entry_date varchar(20),
trx_desc varchar2(30),
constraint pk_trx PRIMARY KEY(trx_id));

===TRX DETAIL===

create table trx_detail(
trx_det_id char(5),
trx_id char(2),
org_gl_id char(5),
amount int,
dorc_flag char(1),
constraint pk_trx_detail PRIMARY KEY(trx_det_id),
constraint fk_trx_detail FOREIGN KEY(trx_id) REFERENCES trx,
constraint fk_trx_detail3 FOREIGN KEY(org_gl_id) REFERENCES org_gl);

===================DML===================

insert into gl_type values(
'1',
'Asset'
);

insert into gl_type values(
'1',
'Asset'
);

insert into gl_type values(
'3',
'Owners Equity'
);

insert into gl_type values(
'4',
'Revenue'
);

insert into gl_type values(
'5',
'Expense'
);

insert into gl values(
'1001',
'Cash');

 insert into gl values(
 '3001',
'modal'
);

insert into trx values(
'T1',
'1 Januari 2014',
'2 Januari 2014',
'nanam modal'
);

insert into org_gl values(
'OJA1',
10000,
'1001'
);

insert into org_gl values(
'OJA2',
10000,
'3001'
);

insert into trx_detail values(
'1',
'T1',
'OJA1',
10000,
'D'
);

insert into trx_detail values(
'2',
'T1',
'OJA2',
10000,
'C'
);