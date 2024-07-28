<?php

/**
 * CertificatePolicies
 *
 * PHP version 5
 *
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2016 Jim Wigginton
 * @license   https://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      https://phpseclib.sourceforge.net
 */

namespace phpseclib3\File\ASN1\Maps;

use phpseclib3\File\ASN1;

/**
 * CertificatePolicies
 *
 * @author  Jim Wigginton <terrafrost@php.net>
 */
abstract class CertificatePolicies
{
    const MAP = [
        'type' => ASN1::TYPE_SEQUENCE,
        'min' => 1,
        'max' => -1,
        'children' => PolicyInformation::MAP
    ];
}
