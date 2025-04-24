## E-procurement System

A web-based procurement platform to streamline purchasing processes, manage vendors, and automate approvals.


## Overview
The E-Procurement System is a digital solution designed to simplify and automate procurement workflows. It enables organizations to:
- ✔ Request and approve purchases efficiently
- ✔ Manage vendors and contracts in one place
- ✔ Track orders and spending with real-time reporting
- ✔ Ensure compliance with procurement policies

Built for businesses, government agencies, and institutions, this system reduces manual paperwork, speeds up approvals, and enhances transparency in procurement.

## ✨ Key Features

- ✅ Purchase Requisition – Submit and track purchase requests.
- ✅ Approval Workflow – Multi-level approval chains with notifications.
- ✅ Vendor Management – Centralized database of suppliers and contracts.
- ✅ Order Tracking – Monitor purchase orders (POs) from request to delivery.
- ✅ Budget Control – Real-time budget checks and spending analytics.
- ✅ Audit Trail – Full history of procurement activities for compliance.
- ✅ Reporting Dashboard – Generate procurement reports (PDF/Excel).



# E-Procurement Release Notes

## v2.3.6 - April 24, 2025

**What’s new in v2.3.6**

* **Enhancement – File Type Adjustment for SPK Attachments**
    * We've updated the settings to ensure that only PDF files can be attached as SPK documents when creating a purchase request based on an SPK. This change promotes file consistency and standardization.
* **Enhancement – Auto-filled Quantity from Pre-Purchase Request**
    * When selecting items from a Pre-Purchase Request to be included in a Purchase Request, the quantity field will now be automatically populated with the maximum quantity specified in the Pre-Purchase Request. This enhancement reduces manual data entry and minimizes the potential for errors.

## v2.3.5 - December 31, 2024

**What’s new in v2.3.5**

* **Enhancement – Additional APIs**
    * We've added several new APIs to improve the performance and capabilities of applications integrated with our E-Procurement system.

## v2.3.4 - December 23, 2024

**What’s new in v2.3.4**

* **Bug Fix – Import Pre-PR Data**
    * We have resolved an issue that prevented users from importing data from XLSX files into the Pre-PR feature. This functionality has been restored and is now working as expected.

## v2.3.3 - December 13, 2024

**What’s new in v2.3.3**

* **Enhancement – History Search**
    * We've made significant improvements to the History feature, enabling more efficient searching. You can now filter the history by:
        * Purchase Order ID
        * Vendor
        * Name
        * Invoice ID
* **Enhancement - Purchase Request**
    * An adjustment has been made to a feature within the Purchase Request module to enhance its overall functionality.

## v2.3.2 - December 09, 2024

**What’s new in v2.3.2**

* **Bug Fix – Unable to Add New Items in Pre-Purchase Request (Pre-PR)**
    * We have resolved a server-side issue that was preventing users from adding new items to the Pre-Purchase Request (Pre-PR) feature.

## v2.3.1 - December 06, 2024

**What’s new in v2.3.1**

* **Enhancement - Purchase Request**
    * We've modified the Purchase Request feature to allow users to change the department when creating a purchase request with the "SPK Completed" type.

## v2.3 - December 05, 2024

**What’s new in v2.3**

* **Enhancement - Purchase Order**
    * Improvements have been implemented in the Purchase Order feature to streamline and simplify the overall purchase order process.
* **Enhancement - Purchase Request**
    * The Purchase Request feature has been enhanced to improve its efficiency.
* **New Feature - Export Cost Project**
    * We've introduced a new "Export Cost Project" feature to help you track and manage project costs more effectively:
        * Users can now export project cost data in a more easily understandable format for further analysis.
        * Options are available to export data based on specific projects.
        * Provides detailed and accurate cost reports to support better decision-making.
* **New Feature - Manage Purchase Requests**
    * The "Manage Purchase Requests" feature has been updated to provide users with greater control over purchase request tracking:
        * Users can now easily monitor the status of all purchase requests.
        * Filters have been added to sort and manage requests based on location.
* **Bug Fix - Delivery Feature**
    * We have fixed a bug in the Delivery feature:
        * Previously, Purchase Orders (POs) marked as "done" in the delivery status were not being removed from the Delivery In list. This issue has now been resolved, and completed deliveries will be automatically removed.
        * This fix improves data accuracy and ensures that the delivery list remains clean and up-to-date.

## v2.2 - October 23, 2024

**What’s new in v2.2**

* **Added New Feature “Purchase Request SPK Based”**
    * Introducing a new feature called "Purchase Request SPK Based." Recognizing that many purchases utilize "SPK" (Surat Perintah Kerja - Work Order) and that this data was not consistently entered into E-Proc, this new feature allows users to create purchase requests directly from completed "SPK" documents, ensuring all purchase data is accurately recorded within the E-Procurement application.
* **Enhancement for Feature “Finish PR”**
    * The "finish" button functionality for Purchase Requests has been improved. Users can now confidently click "finish" without encountering issues where the PR status becomes "stuck" due to inconsistencies with the associated Purchase Order status.
* **Bug Fix**
    * An issue in the Pre-PR editing process has been resolved. Previously, users could directly edit the Total of an item without modifying the Quantity (Qty) and Buffer columns. This is no longer possible, ensuring data integrity.

## v2.1 - August 27, 2024

**What’s new in v2.1**

* **Added New Feature “Create PR from Pre-PR”:**
    * Introducing the "Create PR from Pre-PR" feature. This new tool allows users to initiate purchase requests directly from the Pre-PR menu, streamlining the procurement process and enhancing efficiency.
* **Delivery feature enhancements:**
    * The delivery feature has undergone a significant update to its workflow. Previously, it was limited to managing deliveries for orders with a "paid" status. We are pleased to announce that it can now be used to manage deliveries for all orders, regardless of their payment status.

## v2 - June 19, 2024

**What’s new in v2**

* **Added New Feature “Pre-Purchase Request”:**
    * Introducing the "Pre-Purchase Request" (Pre-PR) feature. For all purchase requests (PRs) with a project purpose, a Pre-PR must now be created first for the relevant project.
        * **Pre-PR Home:**
            1.  Add button to create new pre-pr data.
            2.  Detail button to view details of the selected project.
            3.  Export button to export pre-pr data to Excel.
            4.  Edit button to modify the selected pre-pr.
            5.  Delete button to remove the pre-pr.
            6.  Import menu to import new data.
        * **Add new Pre-PR:** This page allows you to create a pre-pr for a selected project before making a purchase request. A pre-pr only needs to be created once per project unless modifications are required.
        * **Import Pre-PR:**
            1.  Select project.
            2.  Select due date.
            3.  Upload the Excel file.
            4.  Click the Submit button.
        * **Detail Pre-PR:** This page provides comprehensive information about all items within the pre-pr, including quantities purchased, remaining quantities, and associated PRs.
        * **Add new Purchase Request (PR):** When selecting a project purpose for a PR, the item input method will now utilize a selection based on the previously created pre-pr data, replacing manual input.
* **Added New Feature “Inventory Check”**
    * Introducing the "Inventory Check" feature. Every purchase request (PR) with a project purpose will now undergo an inventory check before stakeholder approval.
        * **Inventory Check Home:**
            1.  Button to approve all PRs instantly.
            2.  Checkbox to select PRs.
            3.  Click to view detailed information of the PR.
        * **Detail Inventory Check:**
            1.  Button to approve the PR.
            2.  Button to reject the PR.
            3.  Button to edit the PR.
        * **Comment Section:** This section allows users to add comments when approving, rejecting, or modifying the quantity of items in a PR, facilitating communication with the PR creator.
        * **Edit Inventory-Checker:** If items requested are partially available in the warehouse, the inventory checker team can adjust the purchase quantity accordingly in this menu.
        * **The Status in Purchase Request Menu:** Three new statuses have been introduced:
            1.  “Waiting Approval Inventory Check”: Indicates the PR is awaiting inventory check.
            2.  “Waiting Approval Request Bayu Nugraha”: Indicates the PR has passed inventory check and is now awaiting stakeholder approval.
            3.  “Rejected From Logistics”: Indicates the PR has been rejected by the inventory checker.