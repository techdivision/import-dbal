# AGENTS.md - import-dbal

## Zweck & Verantwortung

Das `import-dbal` Modul definiert die **Schnittstellen und Verträge** für Datenbankzugriff (DBAL - Database Abstraction Layer) im Pacemaker Import-System. Es ist ein **Tier 1 Modul** und baut auf `import-cache` auf.

**Hauptverantwortung:**
- Definition von DBAL-Interfaces für Datenbankoperationen
- Repository-Pattern für Daten-Persistierung
- Standardisierung von DB-Verträgen für alle Importer

## Architektur & Design Patterns

### Interfaces & Repositories
- **RepositoryInterface**: Basis-Interface für alle Repositories
- **ProductRepositoryInterface**: Spezialisiert für Produkte
- **CategoryRepositoryInterface**: Spezialisiert für Kategorien
- **CustomerRepositoryInterface**: Spezialisiert für Kunden
- **AttributeRepositoryInterface**: Spezialisiert für Attribute

### Verwendete Patterns
- **Repository Pattern**: Abstraktion von Datenbankoperationen
- **Interface-Heavy Design**: Nur Verträge, keine Implementierung
- **Cache Integration**: Nutzt `import-cache` für Caching

## Abhängigkeiten

### Externe Pakete
- **Keine** - Nur Interface-Definitionen

### TechDivision Dependencies
- **import-cache** ^2.0.0 - Für Cache-Interfaces

### Abhängig von diesem Modul (4 Reverse Dependencies)
1. **import** - Core Framework nutzt DBAL-Interfaces
2. **import-dbal-collection** - Erweitert DBAL mit Event-Support
3. **import-configuration-jms** - Nutzt DBAL für Konfiguration
4. **import-cli-simple** - Transitiv über andere Module

## Wichtige Entry Points

### Repository Interfaces
```php
// Basis Repository
RepositoryInterface::create($row): void
RepositoryInterface::update($row): void
RepositoryInterface::delete($row): void
RepositoryInterface::findOne($id): array

// Spezialisierte Repositories
ProductRepositoryInterface::findBySku($sku): array
CategoryRepositoryInterface::findByPath($path): array
CustomerRepositoryInterface::findByEmail($email): array
```

### Verwendungsbeispiel
```php
// In Importern
$repository = $repositoryFactory->create(ProductRepositoryInterface::class);
$product = $repository->findBySku('PRODUCT-SKU');
$repository->update(['entity_id' => $product['entity_id'], 'name' => 'New Name']);
```

## Events & Extension Points

**Keine Events** - Tier 1 Modul mit reinen Interfaces

## Hints für KI-Agenten

### Wichtig zu verstehen
1. **Tier 1 Modul**: Baut auf Tier 0 auf, definiert Verträge
2. **Repository Pattern**: Zentral für alle Datenbank-Operationen
3. **Cache-Integration**: Nutzt `import-cache` für Performance
4. **Spezialisierte Repositories**: Für verschiedene Entity-Typen

### Bei Änderungen
- **Interface-Änderungen sind Breaking Changes**
- **Neue Repository-Typen**: Müssen in Implementierungen hinzugefügt werden
- **Cache-Konsistenz**: Beachte Cache-Invalidierung bei Updates

### Implementierungs-Hinweise
- Nutze `RepositoryInterface` als Basis für neue Repositories
- Implementiere spezialisierte Interfaces für Entity-Typen
- Beachte Cache-Strategien bei Implementierung

## Häufige Use Cases

### Repository-Nutzung-Muster
```php
// Finder-Methods
$product = $productRepository->findBySku('SKU-123');
$category = $categoryRepository->findByPath('Catalog/Category/Path');
$customer = $customerRepository->findByEmail('customer@example.com');

// CRUD-Operationen
$repository->create(['sku' => 'NEW-SKU', 'name' => 'New Product']);
$repository->update(['sku' => 'OLD-SKU', 'name' => 'Updated']);
```

### Szenarien
1. **Entity-Lookup**: Schnelle Find-by-ID, SKU, Email Operationen
2. **Bulk-Updates**: Batch-Updates via Repository
3. **Cache-Integration**: DBAL arbeitet mit Cache-Layer

## Performance-Überlegungen

- **Interface-Overhead**: Minimal - nur polymorphic dispatch
- **Implementierungs-abhängig**: Performance hängt von Tier 2 Implementierung ab
- **Cache-Benefit**: Mit `import-cache` können 80-90% der Lookups aus Cache erfolgen
- **Batch-Operations**: Repository-Pattern ermöglicht Batch-Optimierungen
- **Finder-Performance**: Spezialisierte Finder (findBySku, etc.) können optimiert sein

## Verwandte Module

- **import-dbal-collection**: Implementiert diese Interfaces mit Collections
- **import-cache**: DBAL nutzt Cache für Performance
- **import**: Core Framework nutzt DBAL-Repositories
- **import-dbal** ← **diese Datei** (nur Interfaces!)

## Troubleshooting & FAQ

**Q: Wo ist die SQL-Implementierung?**
- A: Nicht hier! Schema in `import-dbal-collection` für Collection-basierte Implementierung.

**Q: Kann ich eigenes Repository bauen?**
- A: Ja! Implementiere `RepositoryInterface` und spezialisierte Interfaces.

**Q: Wie cache ich diese Repository-Calls?**
- A: Via `import-cache` - DBAL-Implementierungen sind mit `CacheAdapterInterface` integriert.

## Bekannte Einschränkungen

- **Nur Interfaces**: Keine konkrete Implementierung
- **Keine SQL-Logik**: SQL-Implementierung ist in `import-dbal-collection`
- **Keine Transaktionen**: Transaktions-Handling erfolgt in Implementierungen

## Zusammenfassung

`import-dbal` ist ein **Tier 1 Modul**, das Schnittstellen für Datenbankzugriff definiert. Es ermöglicht verschiedene DBAL-Implementierungen (Collection-basiert, Custom, etc.) ohne Abhängigkeit vom Kern-Framework.

**Für Agenten:** Verstehe dieses Modul als **Datenbank-Verträge** mit Repository-Pattern.
