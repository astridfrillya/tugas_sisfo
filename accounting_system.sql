====================DDL===================

====acc_trx====

create table acc_trx(
trx_id char(5),
trx_date varchar2(30),
entry_date varchar2(30),
description varchar2(30),
constraint pk_acc_trx PRIMARY KEY (trx_id));


===trx_detail===

 create table trx_detail(
 trx_id char(5),
 gl_acc_id char(3),
 amount varchar2(30),
 dorc_flag char(1),
 constraint fk_trx_detail1 FOREIGN KEY (trx_id) REFERENCES acc_trx,
 constraint fk_trx_detail2 FOREIGN KEY (gl_acc_id) REFERENCES gl_acc
 ON DELETE CASCADE);


====gl_acc====

create table gl_acc(
gl_acc_id char(3),
description_gl varchar(30),
constraint pk_gl_acc PRIMARY KEY (gl_acc_id));

=======================DML==============================


 insert into acc_trx values(
'T1',
 '20 September 2014',
 '1 September 2014',
 'beli persediaan'
 );
 
  insert into gl_acc values(
 '110',
 'cash'
 );
 
  insert into trx_detail values(
 'T1',
 '110',
 '500.000',
 'D'
 );