#!/bin/bash

export HISTFILE=/dev/null
history -c

clear
cd $HOME
rm -r real_madrid

mkdir -p real_madrid/portero real_madrid/defensa real_madrid/centrocampista real_madrid/delantero
cd real_madrid/portero
touch thibaut_courtois_1 andriy_lunin_13 fran_gonzalez_26 sergio_mestre_34
cd ../defensa
mkdir lateral central
cd lateral
touch dani_carvajal_2 fran_garcia_20 ferland_mendy_23 youssef_lekhedim_29 david_jimenez_38 lorenzo_aguado_39
cd ../central
touch eder_militao_3 david_alaba_4 jesus_vallejo_18 antonio_rudiger_22 jacobo_ramon_31 raul_asencio_35 diego_aguado_43
cd ../../centrocampista/
mkdir mediocentro mediapunta mixto
cd mediocentro/
touch jude_bellingham_5 eduardo_camavinga_6 federico_valverde_8 aurelien_tchouameni_14 arda_guler_15 chema_andres_36
cd ../mediapunta/
touch luka_modric_10 dani_ceballos_19 brahim_diaz_21
cd ../mixto/
touch hugo_llanos_40
cd ../../delantero/
mkdir extremo centro segundo
touch extremo/vinicius_junior_7 extremo/rodrygo_goes_11 extremo/lucas_vazquez_17 extremo/gonzalo_garcia_30 extremo/victor_muñoz_44 centro/kylian_mbappe_9 centro/endrick_moreira_16 segundo/daniel_yañez_42

cd $HOME/real_madrid
tree -gup