from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import json

# Inicializar el navegador
driver = webdriver.Chrome()
driver.get("https://www.laliga.com/clubes/levante-ud/estadisticas")

# Esperar y cerrar el pop-up de cookies
WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, '//button[text()="Aceptar"]'))).click()

# Esperar hasta que los elementos con la clase "card" estén disponibles
WebDriverWait(driver, 20).until(EC.presence_of_all_elements_located((By.CLASS_NAME, "card")))

# Buscar los elementos con la clase "card"
card_elements = driver.find_elements(By.CLASS_NAME, "card")

# Extraer la información de cada elemento
card_data = []
for element in card_elements:
    try:
        # Extraer el texto o información relevante de cada tarjeta
        card_text = element.text.strip()  # Puedes ajustar esto según lo que necesitas
        card_data.append({
            "card_info": card_text
        })
    except Exception as e:
        print(f"Error al extraer datos: {e}")

# Guardar los datos extraídos en un archivo JSON
if card_data:
    with open('datos/card_data.json', 'w') as json_file:
        json.dump(card_data, json_file, indent=4)
    print("Datos guardados en datos/card_data.json")
else:
    print("No se encontraron datos.")

# Cerrar el navegador
driver.quit()
