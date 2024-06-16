#!/bin/bash

if [ -z "$1" ]; then
    echo "Uso: $0 'Novo Nome Do Plugin'"
    exit 1
fi

NEW_PLUGIN_NAME="$1"

NEW_PLUGIN_NAME_SLUG=$(echo "$NEW_PLUGIN_NAME" | tr '[:upper:]' '[:lower:]' | sed 's/ /-/g')
NEW_PLUGIN_NAME_UNDERSCORE=$(echo "$NEW_PLUGIN_NAME" | tr '[:upper:]' '[:lower:]' | sed 's/ /_/g')
NEW_PLUGIN_NAME_CONSTANT=$(echo "$NEW_PLUGIN_NAME" | tr '[:lower:]' '[:upper:]' | sed 's/ /_/g')
NEW_PLUGIN_NAME_CAMEL=$(echo "$NEW_PLUGIN_NAME" | sed -r 's/(^| )([a-z])/\U\2/g' | sed 's/ //g')

OLD_PLUGIN_NAME="cf7-postmeta-tag"
OLD_PLUGIN_NAME_UNDERSCORE="cf7_postmeta_tag"
OLD_PLUGIN_NAME_CONSTANT="CF7_POSTMETA_TAG"
OLD_PLUGIN_NAME_SPACED="CF7 Postmeta Tag"
OLD_PLUGIN_NAME_CAMEL="CF7PostmetaTag"

PLUGIN_DIR=$(pwd)

NEW_PLUGIN_DIR="$PLUGIN_DIR/../$NEW_PLUGIN_NAME_SLUG"

mkdir -p "$NEW_PLUGIN_DIR"

rsync -av --progress --exclude='.git' "$PLUGIN_DIR/" "$NEW_PLUGIN_DIR"

replace_strings_in_files() {
    for file in $(grep -rl "$1" "$NEW_PLUGIN_DIR"); do
        sed -i "s/$1/$2/g" "$file"
    done
}

replace_strings_in_files "$OLD_PLUGIN_NAME" "$NEW_PLUGIN_NAME_SLUG"
replace_strings_in_files "$OLD_PLUGIN_NAME_UNDERSCORE" "$NEW_PLUGIN_NAME_UNDERSCORE"
replace_strings_in_files "$OLD_PLUGIN_NAME_CONSTANT" "$NEW_PLUGIN_NAME_CONSTANT"
replace_strings_in_files "$OLD_PLUGIN_NAME_SPACED" "$NEW_PLUGIN_NAME"
replace_strings_in_files "$OLD_PLUGIN_NAME_CAMEL" "$NEW_PLUGIN_NAME_CAMEL"

mv "$NEW_PLUGIN_DIR/$OLD_PLUGIN_NAME.php" "$NEW_PLUGIN_DIR/$NEW_PLUGIN_NAME_SLUG.php"

echo "Configuração do plugin $NEW_PLUGIN_NAME concluída com sucesso."
