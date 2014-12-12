======================================DDL=================================================

create table req_type(
req_type_id varchar(10),
description varchar(50),
constraint pk_req_type PRIMARY KEY (req_type_id));

create table work_req(
work_req_id varchar(10),
fk_work_req varchar(10) REFERENCES req_type(req_type_id),
req_creation_date varchar(20),
req_by_date varchar(20),
description varchar(50), 
PRIMARY KEY (work_req_id)
);

 create table work_req_type(
 wrt_id varchar(10),
 fk_work_req_type varchar(10) REFERENCES work_req(work_req_id),
 description varchar(50),
 product varchar(50),
 quantity int,
 deliverable varchar(50),
PRIMARY KEY (wrt_id)
);
 
 create table req_role_type(
 rrt_id varchar(10),
 des varchar(30),
 constraint pk_rrt PRIMARY KEY (rrt_id));
 
 create table party(
 party_id varchar(10),
 name varchar(30),
 constraint pk_party PRIMARY KEY (party_id));
 
create table party_work_req_role(
pwrr_id varchar(10),
fk_pwrr varchar(10) REFERENCES work_req(work_req_id),
fk_pwrr2 varchar(10)   REFERENCES req_role_type(rrt_id),
fk_pwrr3 varchar(10)  REFERENCES party(rrt_id),
from_date varchar(20),
thru_date varchar(20),
constraint pk_pwrr PRIMARY KEY (pwrr_id)
);

create table order_item(
oi_seq_id varchar(10),
est_deliv_date varchar(20),
quantity int,
unit_price int,
constraint pk_oi PRIMARY KEY (oi_seq_id));

 create table we_type(
 wetype_id varchar(10),
 des varchar(50),
 standard_work_hours int,
 constraint pk_we_type PRIMARY KEY (wetype_id));
 
 create table work_effort(
we_id varchar(10),
fk_we varchar(10)  REFERENCES we_type(wetype_id),
name varchar(30),
des varchar(50),
start_date varchar(20),
completion_date varchar(20),
estimated_hours int,
constraint pk_we PRIMARY KEY (we_id),
);

create table we_from_order_item(
wfoi_id varchar(10),
fk_wfoi2 varchar(10) REFERENCES work_effort(we_id),
fk_wfoi varchar(10) REFERENCES order_item(oi_seq_id),
req_item varchar(10),
constraint pk_wfoi PRIMARY KEY (wfoi_id)
 );

create table we_from_work_req(
wfwr_id varchar(10),
fk_wfwr varchar(10)  REFERENCES work_effort(we_id),
fk_wfwr2 varchar(10) REFERENCES work_req(work_req_id),
constraint pk_wfwr PRIMARY KEY (wfwr_id));

create table we_breakdown(
id varchar(10),
fk_we_bd varchar(10) REFERENCES work_effort(we_id),
we_id varchar(10),
constraint pk_we_bd PRIMARY KEY (id)
); 

create table we_party_assignment_data(
wepad_id varchar(10),
 fk_wepad varchar(10) REFERENCES work_effort(we_id),
 fk_wepad2 varchar(10)  REFERENCES party(party_id),
we_role_type varchar(50),
from_date varchar(20),
thru_date varchar(20),
com varchar(50),
constraint pk_wepad PRIMARY KEY (wepad_id)
);

create table party_skill_data(
psd_id varchar(10),
fk_psd varchar(10) REFERENCES party(party_id),
skill_type varchar(50),
years_of_exp int,
rating int,
constraint pk_partyskill PRIMARY KEY (psd_id));


create table we_status(
status_id varchar(10),
cfk_we_status varchar(10)  REFERENCES we_breakdown(id),
status varchar(50),
constraint pk_we_status PRIMARY KEY (status_id)
);

create table time_sheet_entry(
tse_id varchar(10),
ts_from varchar(20),
ts_thru varchar(20),
fk_tse varchar(10) REFERENCES party(party_id),
we_id varchar(10),
te_from varchar(20),
te_thru varchar(20),
hours int,
constraint pk_tse PRIMARY KEY (tse_id)
);

create table rare_type(
raretype_id varchar(10),
des varchar(50),
constraint pk_rt PRIMARY KEY (raretype_id));

create table we_rate(
werate_id varchar(10),
work_task varchar(50),
fk_werate varchar(10) REFERENCES party(party_id),
fk_werate2 varchar(10) REFERENCES rare_type(raretype_id),
from_date varchar(10),
thru_date varchar(10),
rate int,
constraint pk_werate PRIMARY KEY (werate_id)
);

create table fixed_asset_type(
fat_id varchar(10),
des varchar(10),
parent_asset varchar(30),
constraint pk_fat PRIMARY KEY (fat_id));

create table fixed_asset(
fasset_id varchar(10),
fk_fasset varchar(10) REFERENCES fixed_asset_type(fat_id),
name varchar(50),
date_acquired varchar(20),
last_service varchar(20),
next_service varchar(20),
prod_capacity int,
uom varchar(20),
constraint pk_fasset PRIMARY KEY (fasset_id)
);

create table fixed_asset_assign(
faa_id varchar(10),
fk_faa varchar(10) REFERENCES work_effort(we_id),
fk_faa2 varchar(10) REFERENCES fixed_asset_type(fat_id),
from_date varchar(10),
thru_date varchar(10),
comm varchar(50),
constraint pk_faa PRIMARY KEY (faa_id)
);

create table party_faa(
pfaa_id varchar(10),
fk_pfaa varchar(10) REFERENCES party(party_id),
fk_pfaa2 varchar(10)  REFERENCES fixed_asset_type(fat_id),
start_date varchar(10),
end_date varchar(10),
status varchar(20),
constraint pk_pfaa PRIMARY KEY (pfaa_id)
);

create table we_good_standard(
wegs_id varchar(10),
fk_wegs varchar(10) REFERENCES we_type(wetype_id),
item varchar(50),
est_quantity int,
est_cost int,
constraint pk_wegs PRIMARY KEY (wegs_id)
);

create table we_fa_req(
wefr_id varchar(10),
fk_wefr varchar(10)  REFERENCES we_type(wetype_id),
fk_wefr2 varchar(10)  REFERENCES fixed_asset_type(fat_id),
est_quantity int,
est_duration varchar(20),
constraint pk_wefr PRIMARY KEY (wefr_id)
);


