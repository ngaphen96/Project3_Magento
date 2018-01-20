<?php

namespace Project3\StockStatus\Block\Product;
class Status extends \Magento\Framework\View\Element\Template
{

    const XML_PATH_STOCKSTATUS_ENABLEDSTATUS = 'stockstore/statuspage/enabled_status';
    const XML_PATH_STOCKSTATUS_ENABLEDNUMBER = 'stockstore/statuspage/enabled_number';
    const XML_PATH_STOCKSTATUS_FONTFAMILY = 'stockstore/design/font_family';
    const XML_PATH_STOCKSTATUS_FONTSIZE = 'stockstore/design/font_size';
    const XML_PATH_STOCKSTATUS_FONTWEIGHT = 'stockstore/design/font_weight';
    const XML_PATH_STOCKSTATUS_FONTCOLOR = 'stockstore/design/font_color';
    const XML_PATH_STOCKSTATUS_BACKGROUNDCOLOR = 'stockstore/design/background_color';
    const XML_PATH_STOCKSTATUS_TEXTALIGN = 'stockstore/design/text_align';
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlInterface;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    protected $productFactory;

    /**
     * @param \Magento\Framework\UrlInterface $urlInterface
     * @param Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */


    public function __construct(\Magento\Framework\View\Element\Template\Context $context,
                                \Magento\Framework\UrlInterface $urlInterface,
                                \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
                                \Magento\Catalog\Model\ProductFactory $product
    )
    {
        parent::__construct($context);
        $this->urlInterface = $urlInterface;
        $this->scopeConfig = $scopeConfig;
        $this->productFactory = $product;
    }

    public function getProductId()
    {
        $data = $this->_request->getParam('id');
        return $data;
    }

    public function getStatus()
    {
        $isEnabled = $this->scopeConfig->getValue(self::XML_PATH_STOCKSTATUS_ENABLEDSTATUS, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $isEnabled;
    }
    public function getNumber()
    {
        $isNumber = $this->scopeConfig->getValue(self::XML_PATH_STOCKSTATUS_ENABLEDNUMBER, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $isNumber;
    }

    public function getType()
    {
        $id = $this->getProductId();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $stockRegistry = $objectManager->get('Magento\CatalogInventory\Api\StockRegistryInterface');

        $product = $this->productFactory->create()->load($id);

        $stockitem = $stockRegistry->getStockItem(
            $product->getId(),
            $product->getStore()->getWebsiteId()
        );
        $productArray = [];
        $productArray['type'] = $product->getTypeId();
        $productArray['price'] = $product->getPrice();
        $productArray['sku'] = $product->getSku();
        $productArray['qty'] = $stockitem->getQty();
        $productArray['status'] = $product->getData('custom_stock_status');
        $productArray['numberleft'] = $product->getData('notice_number_left');
        return $productArray;
    }
    //Get font-family
    public function getFontFamily()
    {
        return $fontFamily = $this->scopeConfig->getValue(
            self::XML_PATH_STOCKSTATUS_FONTFAMILY,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    //Get font-size
    public function getFontSize()
    {
        return $fontSize = $this->scopeConfig->getValue(
            self::XML_PATH_STOCKSTATUS_FONTSIZE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    //Get font-weight
    public function getFontWeight()
    {
        return $fontWeigth = $this->scopeConfig->getValue(
            self::XML_PATH_STOCKSTATUS_FONTWEIGHT,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    //Get text-align
    public function getTextAlign()
    {
        return $textAlign = $this->scopeConfig->getValue(
            self::XML_PATH_STOCKSTATUS_TEXTALIGN,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    //Get font-color
    public function getFontColor()
    {
        return $fontColor = $this->scopeConfig->getValue(
            self::XML_PATH_STOCKSTATUS_FONTCOLOR,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    //Get background-color
    public function getBackgroundColor()
    {
        return $backgroundColor = $this->scopeConfig->getValue(
            self::XML_PATH_STOCKSTATUS_BACKGROUNDCOLOR,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }




}