# TermsToTax  

Contributors: rafywp  
Tags: taxonomy, csv import, terms, wordpress taxonomies, import terms  
Requires at least: 5.2  
Tested up to: 6.4  
Requires PHP: 7.2  
Stable tag: 1.0.0  
License: GPL-2.0-or-later  
License URI: [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html)  
Donate link: [https://rafy.com.br/donate](https://rafy.com.br/donate)  

Import terms into any WordPress custom taxonomy using a CSV file. Simple, fast, and efficient.  

---

## Description  

TermsToTax lets you **import taxonomy terms from a CSV file** directly into WordPress. Instead of manually adding terms one by one, just upload a **CSV file**, select the taxonomy, and let the plugin do the rest.  

### Features  

**CSV Import**
Upload a CSV file to bulk import terms.  

**Custom Taxonomy Support**
Works with WooCommerce product categories and all registered taxonomies.  

**Automatic Slug Generation**
If no slug is provided, the plugin creates one automatically.  

**Admin Panel Integration**
Manage imports easily from the WordPress admin area.  

**Error Handling & Logging**
Detects duplicate terms and prevents incorrect data entries.  

This plugin is ideal for developers, content managers, and WooCommerce store owners who need an efficient way to manage taxonomy terms.  

---

## Installation  

**Install via WordPress Plugin Directory**

1. Go to **WordPress Dashboard** → **Plugins** → **Add New**.  
2. In the **Search Plugins** field, type **TermsToTax**.  
3. Click **Install Now** on the TermsToTax plugin.  
4. Once installed, click **Activate**.  
5. Navigate to **Terms Importer** in the WordPress admin menu.  
6. Select a taxonomy, upload your file, and click **Import Terms**.  

---

**Install via Upload**

1. Download the terms-to-tax.zip file.  
2. Go to **WordPress Dashboard** → **Plugins** → **Add New**.  
3. Click **Upload Plugin**, select the terms-to-tax.zip file, and click **Install Now**.  
4. Click **Activate Plugin** once the installation is complete.  
5. Navigate to **Terms Importer** in the WordPress admin menu.  
6. Select a taxonomy, upload your file, and click **Import Terms**.  

---

**Install via FTP**

1. Extract the **terms-to-tax.zip** file.  
2. Upload the extracted folder to **/wp-content/plugins/** via FTP.  
3. Go to **WordPress Dashboard** → **Plugins**.  
4. Find **TermsToTax** in the list and click **Activate**.  
5. Navigate to **Terms Importer** in the WordPress admin menu.  
6. Select a taxonomy, upload your file, and click **Import Terms**.  

---

## Frequently Asked Questions  

### What format should the CSV file be in?  
Your CSV file should follow this structure:  

name,slug,description
Category One,category-one,This is the first category.
Category Two,category-two,This is the second category. 

### What happens if I upload a duplicate term?  
If the term already exists in the selected taxonomy, the import will fail.  

### Can I import terms into WooCommerce product categories?  
Yes, WooCommerce **product categories (product_cat)** are fully supported.  

### What if my CSV file is missing fields?  
If a required field is missing, the import will fail.  

- The **name** field is required.  
- The **slug** is optional (auto-generated if missing).  
- The **description** is optional.  

---

## Screenshots  

1. **Admin Panel Dashboard:** Select a taxonomy and upload a CSV file.  
2. **Successful Import:** Imported Terms.  
3. **Error Handling:** Example of an error message when a term fails to import.  

---

## Changelog  

### 1.0.0  
- Initial release.  
- Supports bulk import of taxonomy terms via CSV.  
- Compatible with WooCommerce and all custom taxonomies.  

---

## Upgrade Notice  

### 1.0.0  
First stable release. Easily import terms into WordPress taxonomies using a CSV file.  

---

## License  

This plugin is licensed under the **GPL-2.0-or-later**. 
See [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html) for details.  

---

## Support  

For support and feature requests, visit:  
🔗 [https://rafy.com.br/project/terms-to-tax/](https://rafy.com.br/project/terms-to-tax/)  
