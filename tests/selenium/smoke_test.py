from selenium import webdriver
from selenium.webdriver.chrome.options import Options
from selenium.webdriver.common.by import By

options = Options()
options.add_argument('--headless=new')
options.add_argument('--no-sandbox')
options.add_argument('--disable-dev-shm-usage')

try:
    driver = webdriver.Chrome(options=options)
    driver.get('http://127.0.0.1:8000/login')
    title = driver.title
    print("SUCCESS: Connected to login page, title:", title)
    driver.quit()
except Exception as e:
    print("ERROR:", e)
