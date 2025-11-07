# adminer-multi-databases
A plugin for Adminer that supports independent account configuration for database connections.


```mermaid
%%{init: { "themeVariables": { "primaryColor": "#0b5fff", "edgeLabelBackground":"#ffffff" }}}%%
graph TB
  subgraph PrimarySite["主站（Local Primary）"]
    A_App["应用服务器\n(App)"]
    A_DB["数据库\n(DB)"]
    A_LocalDisk["本地存储\nRAID1"]
    A_LVM["本机快照 (LVM/ZFS snapshot)\n-> 用于一致性回滚"]
    A_Agent["备份 Agent\n(rsnapshot/restic/borg/rsync)"]
  end

  subgraph BackupNode["同城备份/复制节点\n(Backup Node)"]
    B_BackupStorage["备份存储\n(磁盘 / NAS)"]
    B_Dedup["去重 & 加密\n(restic/borg)"]
    B_Archive["长期归档\n(tape / object storage)"]
  end

  subgraph Network["网络 / 传输"]
    NET["加密传输\n(SSH/TLS)"]
  end

  subgraph Observability["监控与验证"]
    M_Prom["监控 (Prometheus)"]
    M_Alert["告警 (Alertmanager/邮件/SMS)"]
    M_SMART["SMART / mdadm / smartd"]
    M_Verify["备份验证\n(自动校验 + 定期恢复演练)"]
  end

  subgraph Schedules["备份策略 & 调度"]
    S_WAL["WAL/binlog 实时/每5-15m\n(关键数据，保留 >=7 天)"]
    S_Inc["文件增量 每小时\n(RPO <=1h)"]
    S_Full["每日全备，周全备，月归档(12个月)"]
    S_Retention["保留：短期7-14天，中期30-90天，长期>=1年"]
  end

  %% flows
  A_App -->|写入| A_DB
  A_DB -->|WAL/binlog -> archive| S_WAL
  A_LocalDisk --> A_LVM
  A_LVM --> A_Agent
  A_Agent -->|增量/全量备份(加密)| NET
  NET --> B_Dedup
  B_Dedup --> B_BackupStorage
  B_BackupStorage --> B_Archive
  M_SMART --> M_Prom
  M_Prom --> M_Alert
  B_BackupStorage --> M_Verify
  M_Verify --> M_Alert
  S_Inc --> A_Agent
  S_Full --> A_Agent
  S_Retention --> B_BackupStorage
  %% restore path
  B_BackupStorage -->|恢复数据| A_LocalDisk
  B_BackupStorage -->|恢复演练| M_Verify
```
