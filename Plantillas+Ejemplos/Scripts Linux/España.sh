#!/bin/bash

# Definición de provincias por Comunidad Autónoma
declare -A provincias_por_ccaa=(
    ["andalucia"]="almeria,cadiz,cordoba,granada,huelva,malaga,sevilla"
    ["aragon"]="huesca,teruel,zaragoza"
    ["asturias"]="oviedo,gijon"
    ["islas_baleares"]="mallorca,menorca,ibiza"
    ["cantabria"]="santander"
    ["castilla_la_mancha"]="albacete,ciudad_real,cuenca,guadalajara,toledo"
    ["castilla_y_leon"]="avila,burgos,leon,palencia,salamanca,segovia,soria,valladolid,zamora"
    ["cataluna"]="barcelona,girona,lleida,tarragona"
    ["extremadura"]="badajoz,caceres"
    ["galicia"]="a_coruna,lugo,ourense,pontevedra"
    ["madrid"]="madrid"
    ["murcia"]="murcia"
    ["navarra"]="pamplona"
    ["la_rioja"]="logrono"
    ["pais_vasco"]="vitoria,bilbao"
    ["valencia"]="alicante,castellon,valencia"
)

# Monumentos por ciudad
declare -A monumentos=(
    ["almeria"]="catedral_de_almeria"
    ["cadiz"]="torre_tavira"
    ["cordoba"]="mezquita"
    ["granada"]="alhambra"
    ["huelva"]="muelle"
    ["malaga"]="catedral"
    ["sevilla"]="catedral,alcazar"
    ["oviedo"]="catedral"
    ["gijon"]="cimavilla"
    ["mallorca"]="catedral"
    ["menorca"]="fortaleza_de_mola"
    ["ibiza"]="puerto"
    ["huesca"]="catedral"
    ["teruel"]="iglesia_de_san_pedro"
    ["zaragoza"]="basilica_del_pilar,palacio_de_la_aljaferia"
    ["santander"]="palacio_de_la_magdalena,plaza_porticada"
    ["albacete"]="plaza_de_las_cortes"
    ["ciudad_real"]="castillo"
    ["cuenca"]="casas_colgadas"
    ["guadalajara"]="palacio_del_duque"
    ["toledo"]="catedral"
    ["avila"]="murallas"
    ["burgos"]="catedral"
    ["leon"]="basilica_de_san_isidoro"
    ["palencia"]="iglesia_de_san_miguel"
    ["salamanca"]="universidad"
    ["segovia"]="acueducto"
    ["soria"]="castillo"
    ["valladolid"]="plaza_mayor"
    ["zamora"]="castillo"
    ["barcelona"]="sagrada_familia,parque_guell"
    ["girona"]="puente_de_ferro"
    ["lleida"]="catedral"
    ["tarragona"]="anfiteatro"
    ["badajoz"]="alcazaba,puente_real"
    ["caceres"]="torre_de_bellota"
    ["a_coruna"]="torre_de_hercules,jardines_de_maria_pita"
    ["lugo"]="murallas"
    ["ourense"]="termas"
    ["pontevedra"]="monasterio"
    ["madrid"]="palacio_real,puerta_del_sol"
    ["murcia"]="catedral"
    ["pamplona"]="plaza_del_castillo"
    ["logrono"]="concatedral"
    ["vitoria"]="plaza_de_la_victoria"
    ["bilbao"]="puente_colgante"
    ["alicante"]="castillo"
    ["castellon"]="plaza_de_las_aulas"
    ["valencia"]="mercado_de_colon"
)

# Lista de nombres únicos
nombres=(
    "maria_jose" "antonio_jesus" "carmen" "juan_carlos" "ana_maria"
    "francisco_javier" "rosa_maria" "sergio" "laura" "david"
    "elena" "manuel" "isabel" "alejandro" "sofia"
    "carlos" "paula" "diego" "martina" "jorge"
    "marina" "raul" "clara" "adrian" "beatriz"
    "oscar" "lucia" "daniel" "nadia" "miguel"
    "sandra" "pablo" "julia" "rafael" "andrea"
    "marcos" "angela" "alberto" "victoria" "samuel"
    "maria_angeles" "juan_antonio" "alicia" "jose_luis" "sara"
    "pedro" "elena_maria" "mario" "patricia" "jose_manuel"
    "eva" "gabriel" "silvia" "gonzalo" "marina"
    "rodrigo" "catalina" "ruben" "noelia" "ivan"
    "pilar" "emilio" "rocio" "bruno" "jimena"
    "joaquin" "valentina" "aaron" "valeria" "marcos"
    "camila" "hugo" "daniela" "mateo" "paula"
    "martin" "valeria" "diego" "isabella" "lucas"
    "maria_fernanda" "sebastian" "camila" "nicolas" "isabella"
    "marina_isabel" "jose_miguel" "laura_elena" "daniel_alejandro"
    "sofia_martinez" "pablo_garcia" "carolina" "mario_alberto"
    "valentina_rodriguez" "santiago" "julia_torres" "david_jose"
)

# Crear la carpeta principal "espana"
mkdir -p ~/espana

# Crear estructura de directorios
cd ~/espana || exit

for ccaa in "${!provincias_por_ccaa[@]}"; do
    mkdir -p "$ccaa"
    
    IFS=',' read -r -a lista_provincias <<< "${provincias_por_ccaa[$ccaa]}"
    
    for provincia in "${lista_provincias[@]}"; do
        mkdir -p "$ccaa/$provincia"
        
        # Obtener monumentos de la provincia
        IFS=',' read -r -a monumentos_provincia <<< "${monumentos[$provincia]}"
        
        for monumento in "${monumentos_provincia[@]}"; do
            mkdir -p "$ccaa/$provincia/$monumento"
            
            # Verificar si hay nombres disponibles
            if [ ${#nombres[@]} -eq 0 ]; then
                echo "Error: No hay suficientes nombres para todos los monumentos."
                exit 1
            fi
            
            # Tomar un nombre y eliminarlo de la lista
            nombre=${nombres[0]}
            touch "$ccaa/$provincia/$monumento/$nombre"
            nombres=("${nombres[@]:1}")
        done
    done
done

# Mostrar estructura de directorios y archivos
tree -L 4 ~/espana
cd ~
