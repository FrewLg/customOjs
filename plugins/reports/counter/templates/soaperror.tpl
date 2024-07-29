{**
 * plugins/reports/counter/templates/soaperror.tpl
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * SOAP error response
 *}
<?xml version="1.0" encoding="UTF-8"?>
<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="https://schemas.xmlsoap.org/soap/encoding/"
  xmlns:xsi="https://www.w3.org/1999/XMLSchema-instance"
  xmlns:SOAP-ENC="https://schemas.xmlsoap.org/soap/encoding/"
  xmlns:SOAP-ENV="https://schemas.xmlsoap.org/soap/envelope/"
  xmlns:xsd="https://www.w3.org/1999/XMLSchema">
  <SOAP-ENV:Body>
    <SOAP-ENV:Fault>
      <Faultcode>{$Faultcode}</Faultcode>
      <Faultstring>{$Faultstring}</Faultstring>
    </SOAP-ENV:Fault>
</SOAP-ENV:Body>
</SOAP-ENV:Envelope>
