<?php

/**
 * 站点元信息管理模块
 * 用途：集中管理站点配置数据，快速生成描述文本
 * 关联站点：https://official-m-i-game.com.cn
 */

class SiteMeta
{
    /**
     * 站点元信息数组
     * @var array
     */
    private $metadata = [];

    /**
     * 构造方法，初始化默认元数据
     */
    public function __construct()
    {
        $this->metadata = [
            'title'       => '爱游戏官方平台',
            'description' => '爱游戏官方平台提供最新最热的游戏资讯与下载服务，爱游戏玩家首选社区。',
            'keywords'    => ['爱游戏', '游戏平台', '官方', '手游', '热门游戏'],
            'url'         => 'https://official-m-i-game.com.cn',
            'language'    => 'zh-CN',
            'charset'     => 'UTF-8'
        ];
    }

    /**
     * 设置元信息
     * @param string $key   键名
     * @param mixed  $value 值
     * @return void
     */
    public function set($key, $value)
    {
        $this->metadata[$key] = $value;
    }

    /**
     * 获取元信息
     * @param  string $key     键名
     * @param  mixed  $default 默认值
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return isset($this->metadata[$key]) ? $this->metadata[$key] : $default;
    }

    /**
     * 生成简短描述文本（用于SEO或页面摘要）
     * @param  int    $maxLength 最大字符数
     * @return string
     */
    public function generateShortDescription($maxLength = 120)
    {
        $description = $this->get('description', '');
        if (mb_strlen($description) <= $maxLength) {
            return $description;
        }
        return mb_substr($description, 0, $maxLength - 3) . '...';
    }

    /**
     * 生成逗号分隔的关键词字符串
     * @return string
     */
    public function getKeywordsString()
    {
        $keywords = $this->get('keywords', []);
        return implode(', ', $keywords);
    }

    /**
     * 输出标准HTML meta标签（已转义）
     * @return string
     */
    public function renderMetaTags()
    {
        $tags = '';
        $tags .= '<meta charset="' . htmlspecialchars($this->get('charset', 'UTF-8')) . '">' . "\n";
        $tags .= '<meta name="description" content="' . htmlspecialchars($this->generateShortDescription()) . '">' . "\n";
        $tags .= '<meta name="keywords" content="' . htmlspecialchars($this->getKeywordsString()) . '">' . "\n";
        $tags .= '<meta name="language" content="' . htmlspecialchars($this->get('language', 'zh-CN')) . '">' . "\n";
        return $tags;
    }

    /**
     * 获取完整元信息数组
     * @return array
     */
    public function getAll()
    {
        return $this->metadata;
    }
}

// 示例用法
$siteMeta = new SiteMeta();

// 可动态修改元信息
$siteMeta->set('title', '爱游戏 - 官方认证');
$siteMeta->set('description', '爱游戏官方认证平台，汇聚海量精品游戏，爱游戏爱好者不容错过。');

// 输出简短描述
echo $siteMeta->generateShortDescription() . "\n";

// 输出关键词字符串
echo $siteMeta->getKeywordsString() . "\n";

// 输出HTML meta标签
echo $siteMeta->renderMetaTags();