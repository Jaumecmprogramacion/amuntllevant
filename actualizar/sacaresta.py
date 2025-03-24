from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import json
import os
import logging

# Configurar logging
logging.basicConfig(level=logging.INFO, format="%(asctime)s - %(levelname)s - %(message)s")

# Inicializar el navegador
driver = webdriver.Chrome()

# Acceder a la página
url = "https://www.laliga.com/clubes/levante-ud/estadisticas"
driver.get(url)
logging.info(f"Accediendo a {url}")

# Cerrar pop-up de cookies si aparece
try:
    WebDriverWait(driver, 10).until(EC.element_to_be_clickable((By.XPATH, '//button[text()="Aceptar"]'))).click()
    logging.info("Pop-up de cookies cerrado.")
except Exception as e:
    logging.warning(f"No se detectó pop-up de cookies o error al cerrarlo: {e}")

# Esperar la carga de la tabla
try:
    WebDriverWait(driver, 20).until(EC.presence_of_element_located((By.CLASS_NAME, "styled__TableStyled-sc-57jgok-1.kvoOOd")))
    logging.info("Tabla cargada correctamente.")
except Exception as e:
    logging.error(f"Error al esperar la tabla: {e}")
    driver.quit()
    exit()

# Buscar la tabla
tables = driver.find_elements(By.CLASS_NAME, "styled__TableStyled-sc-57jgok-1.kvoOOd")
if not tables:
    logging.error("No se encontró la tabla en la página.")
    driver.quit()
    exit()

table = tables[0]  # Tomar la primera tabla encontrada

# Extraer las filas de la tabla
rows = table.find_elements(By.TAG_NAME, "tr")

# Lista para almacenar los datos de la tabla
table_data = []

# Definir los nombres de las columnas
column_names = [
    "DORSAL", "POSICIÓN", "NOMBRE", "MIN", "PJ", "TIT", "SUP", "SUST", 
    "AM", "ROJ", "DOB", "GOLES", "PEN", "GPP", "GE"
]

# Iterar sobre las filas
for row in rows:
    columns = row.find_elements(By.TAG_NAME, "td")
    if columns:
        row_data = {}
        for idx, column in enumerate(columns[1:], start=0):  # Omitir la primera columna (imagen)
            if idx < len(column_names):
                row_data[column_names[idx]] = column.text.strip()
        if row_data:
            table_data.append(row_data)

# Guardar los datos en JSON si hay información
if table_data:
    os.makedirs("datos", exist_ok=True)
    with open("datos/estadisticasdetalladas.json", "w", encoding="utf-8") as json_file:
        json.dump(table_data, json_file, indent=4, ensure_ascii=False)
    logging.info("Datos guardados en datos/estadisticasdetalladas.json")
else:
    logging.warning("No se encontraron datos en la tabla.")

# Cerrar el navegador
driver.quit()
